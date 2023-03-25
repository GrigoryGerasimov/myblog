<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\BlogController\BlogPostController;

use Rehor\Myblog\controllers\BlogController\BlogController;
use Rehor\Myblog\controllers\BlogController\traits\BlogControllerTrait;
use Rehor\Myblog\controllers\AuthController\AuthController;
use Rehor\Myblog\repositories\PostRepository\PostRepository;
use Rehor\Myblog\repositories\DBConnectorRepository\DBConnectorRepository;

class BlogPostController extends BlogController
{
    use BlogControllerTrait;
    
    protected static $renderData = [];
    
    protected static function getRequestData()
    {
        return DBConnectorRepository::requestConnectorFlight();
    }

    public static function create()
    {
        if (!empty(self::$renderData["notification"])) {
            self::$renderData["notification"] = "";
        };
        
        self::$renderData["isAuth"] = AuthController::checkSession();
        
        if (self::validatePostData(self::getRequestData())) {
            try {
                PostRepository::createNewPost(self::getRequestData());
                
                self::$renderData["notification"] = "Post successfully created!";

            } catch(\Exception $e) {
                self::handleException($e);
            }
        };
        
        self::displayView("posts/create.php", self::$renderData);
        
    }
    
    public static function readOne(string $uid)
    {
        try {
            $result = PostRepository::getOnePost($uid);
            
            if (!is_null($result)) {
                self::$renderData = [
                    "uid" => $uid,
                    "title" => $result["title"],
                    "author" => $result["author"],
                    "text" => $result["text"],
                    "isAuth" => AuthController::checkSession()
                ];
            }

            self::displayView("posts/post.php", self::$renderData);

        } catch(\Exception $e) {
            self::handleException($e);
        }
    }
    
    public static function readAll()
    {
        try {
            $postsList = PostRepository::getAllPosts();
            
            self::$renderData["postsList"] = $postsList;
            self::$renderData["isAuth"] = AuthController::checkSession();

        } catch(\Exception $e) {
            self::handleException($e);
        }

        self::displayView("posts/postsList.php", self::$renderData);
    }
    
    public static function update(string $uid)
    {
        if (!self::validatePostData(self::getRequestData())) {
            $result = PostRepository::getOnePost($uid);
            
            if (!is_null($result)) {
                self::$renderData = [
                    "uid" => $uid,
                    "title" => $result["title"],
                    "author" => $result["author"],
                    "text" => $result["text"],
                    "isAuth" => AuthController::checkSession()
                ];
            }
        } else {
            try {
                $updatedPost = PostRepository::updatePost($uid, self::getRequestData());
                
                if (!is_null($updatedPost)) {
                    self::$renderData["uid"] = $updatedPost["uid"];
                    self::$renderData["title"] = $updatedPost["title"];
                    self::$renderData["author"] = $updatedPost["author"];
                    self::$renderData["text"] = $updatedPost["text"];
                    self::$renderData["notification"] = "Post successfully updated!";
                }
            } catch(\Exception $e) {
                self::handleException($e);
            }
        }

        self::displayView("posts/edit.php", self::$renderData);
    }
    
    public static function delete($uid)
    {
        $result = PostRepository::getOnePost($uid);
        
        if (!is_null($result)) {
            self::$renderData = [
                "uid" => $uid,
                "title" => $result["title"],
                "author" => $result["author"],
                "text" => $result["text"],
                "isAuth" => AuthController::checkSession()
            ];
        }
        
        if (self::validatePostData(self::getRequestData())) {
            try {
                PostRepository::deletePost($uid);
                
                self::$renderData["notification"] = "Post successfully deleted!";

            } catch(\Exception $e) {
                self::handleException($e);
            }
        }
        
        self::displayView("posts/delete.php", self::$renderData);
    }
}