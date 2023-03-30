<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\BlogController\BlogPostController;

use Rehor\Myblog\controllers\BlogController\BlogController;
use Rehor\Myblog\controllers\BlogController\traits\BlogControllerTrait;
use Rehor\Myblog\controllers\AuthController\AuthController;
use Rehor\Myblog\controllers\AdminControllers\AdminController\AdminController;
use Rehor\Myblog\controllers\FileController\FileController;
use Rehor\Myblog\repositories\PostRepository\PostRepository;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorFlightRepository\DBConnectorFlightRepository;
use Rehor\Myblog\repositories\RendererRepository\RendererRepository;

class BlogPostController extends BlogController
{
    use BlogControllerTrait;
    
    protected static $renderData = [];
    
    protected static function getRequestData()
    {
        return DBConnectorFlightRepository::requestConnector();
    }
    
    public static function isAuthorized()
    {
        self::$renderData["isAuth"] = AuthController::checkSession();
        self::$renderData["isAdmin"] = AdminController::checkAdmin();
        
        if (AuthController::checkSession()) {
            self::$renderData["firstname"] = AuthController::retrieveSession()["user_firstname"];
            self::$renderData["lastname"] = AuthController::retrieveSession()["user_lastname"];
        }
    }

    public static function create()
    {
        if (!empty(self::$renderData["notification"])) {
            self::$renderData["notification"] = "";
        };
        
        if (count(self::getRequestData())) {
            
            if (self::validatePostData(self::getRequestData())) {
                
                try {
                    
                    if ($_FILES["file"]["name"]) {
                        try {
                            $newBlogFilePath = FileController::uploadFile("file");
                        } catch (\Exception $e) {
                            self::$renderData["error"] = $e->getMessage();
                        }
                    }

                    $request = self::getRequestData();
                    if (isset($newBlogFilePath) && !empty($newBlogFilePath)) {
                        $request["filepath"] = $newBlogFilePath;
                    }
                    
                    PostRepository::createNewPost(self::getRequestData());

                } catch(\Exception $e) {
                    self::handleException($e);
                }

            } else {
                self::$renderData["error"] = "Imcomplete post data provided! Please fill all the fields and try once again";
            }

            if (!isset(self::$renderData["error"]) || empty(self::$renderData["error"])) {
                self::$renderData["notification"] = "Post successfully created!";
            }
        }

        self::isAuthorized();
        
        if (self::$renderData["isAuth"]) {
            RendererRepository::displayView("posts/create.php", self::$renderData);
        } else {
            header("Location: /posts");
            exit();
        }
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
                    "text" => $result["text"]
                ];
            }
            
            self::isAuthorized();

            RendererRepository::displayView("posts/post.php", self::$renderData);

        } catch(\Exception $e) {
            self::handleException($e);
        }
    }
    
    public static function readAll()
    {
        try {
            $postsList = PostRepository::getAllPosts();

            foreach ($postsList as &$post) {
                $post["description"] = substr($post["text"], 0, 200);
            }
            unset($post);

            self::$renderData["postsList"] = $postsList;

        } catch(\Exception $e) {
            self::handleException($e);
        }
        
        self::isAuthorized();

        RendererRepository::displayView("posts/postsList.php", self::$renderData);
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
                    "text" => $result["text"]
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
        
        self::isAuthorized();

        if (self::$renderData["isAuth"]) {
            
            RendererRepository::displayView("posts/edit.php", self::$renderData);
            
        } else {
            header("Location: /posts/$uid");
            exit();
        }
    }
    
    public static function delete($uid)
    {
        $result = PostRepository::getOnePost($uid);
        
        if (!is_null($result)) {
            self::$renderData = [
                "uid" => $uid,
                "title" => $result["title"],
                "author" => $result["author"],
                "text" => $result["text"]
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
        
        self::isAuthorized();
        
        if (self::$renderData["isAuth"]) {
            
            RendererRepository::displayView("posts/delete.php", self::$renderData);
            
        } else {
            header("Location: /posts/$uid");
            exit();
        }
    }
}