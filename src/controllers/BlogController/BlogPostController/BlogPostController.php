<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\BlogController\BlogPostController;

use Rehor\Myblog\controllers\BlogController\BlogController;
use Rehor\Myblog\controllers\BlogController\traits\BlogControllerTrait;
use Rehor\Myblog\models\Post\Post;

class BlogPostController extends BlogController
{
    use BlogControllerTrait;
    
    protected static $renderData = [];
    
    protected static function getRequestData()
    {
        return \Flight::request()->data;
    }

    public static function create()
    {
        if (!empty(self::$renderData["notification"])) {
            self::$renderData["notification"] = "";
        };
        
        if (self::validatePostData(self::getRequestData())) {
            try {
                $newPost = new Post(self::getRequestData());
                $newPost->add();
                
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
            $post = new Post();
            $result = mysqli_fetch_assoc($post->getOne($uid));
            
            if (!is_null($result)) {
                self::$renderData = [
                    "uid" => $uid,
                    "title" => $result["title"],
                    "author" => $result["author"],
                    "text" => $result["text"]
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
            $post = new Post();
            $postsList = $post->getAll();
            
            self::$renderData["postsList"] = $postsList->fetch_all(MYSQLI_ASSOC);
        } catch(\Exception $e) {
            self::handleException($e);
        }

        self::displayView("posts/postsList.php", self::$renderData);
    }
    
    public static function update(string $uid)
    {
        if (!self::validatePostData(self::getRequestData())) {
            $post = new Post();
            $result = mysqli_fetch_assoc($post->getOne($uid));
            
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
                $postForUpdate = new Post(self::getRequestData());
                $updatedPost = mysqli_fetch_assoc($postForUpdate->update($uid));
                
                if (!is_null($updatedPost)) {
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
        $postToDelete = new Post();
        $result = mysqli_fetch_assoc($postToDelete->getOne($uid));
        
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
                $deletedPost = new Post();
                $deletedPost->delete($uid);
                
                self::$renderData["notification"] = "Post successfully deleted!";
            } catch(\Exception $e) {
                self::handleException($e);
            }
        }
        
        self::displayView("posts/delete.php", self::$renderData);
    }
}