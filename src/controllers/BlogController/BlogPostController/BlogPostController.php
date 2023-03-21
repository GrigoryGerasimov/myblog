<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\BlogController\BlogPostController;

use Rehor\Myblog\controllers\BlogController\BlogController;
use Rehor\Myblog\controllers\BlogController\traits\BlogControllerTrait;
use Rehor\Myblog\models\Post\Post;

class BlogPostController extends BlogController
{
    use BlogControllerTrait;
    
    protected static $notification = "";
    
    protected static function getRequestData()
    {
        return \Flight::request()->data;
    }

    public static function create()
    {
        if (self::validatePostData(self::getRequestData())) {
            try {
                $newPost = new Post(self::getRequestData());
                $newPost->add();

                BlogPostController::$notification = "Posted successfully";
            } catch(\Exception $e) {
                self::handleException($e);
            }
        };
        
        \Flight::view()->display("posts/create.php", array(
            "notification" => BlogPostController::$notification
        ));
    }
    
    public static function readOne(string $uid)
    {
        try {
            $post = new Post();
            $result = mysqli_fetch_assoc($post->getOne($uid));
            
            \Flight::view()->display("posts/post.php", array(
                "uid" => $uid,
                "title" => $result["title"],
                "author" => $result["author"],
                "text" => $result["text"]
            ));
        } catch(\Exception $e) {
            self::handleException($e);
        }
    }
    
    public static function readAll()
    {
        #TODO
    }
    
    public static function update()
    {
        try {
            #TODO
        } catch(\Exception $e) {
            self::handleException($e);
        }
    }
    
    public static function delete()
    {
        try {
            #TODO
        } catch(\Exception $e) {
            self::handleException($e);
        }
    }
}