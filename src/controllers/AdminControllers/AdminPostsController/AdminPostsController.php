<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AdminControllers\AdminPostsController;

use Rehor\Myblog\controllers\AdminControllers\AdminPostsController\interfaces\AdminPostsControllerInterface;
use Rehor\Myblog\controllers\AdminControllers\AdminController\AdminController;
use Rehor\Myblog\controllers\AuthController\AuthController;
use Rehor\Myblog\controllers\DBController\DBController;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorDoctrineRepository\DBConnectorDoctrineRepository;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorFlightRepository\DBConnectorFlightRepository;
use Rehor\Myblog\repositories\SessionRepository\SessionRepository;
use Rehor\Myblog\entities\Post;

class AdminPostsController extends AdminController implements AdminPostsControllerInterface
{
    public static function showAdminPosts(): void
    {
        if (SessionRepository::validateSession()) {
            self::$renderData["firstname"] = SessionRepository::getSession()["user_firstname"];
        }

        self::show("admin/admin-posts/admin-posts.php", [
            "firstname" => SessionRepository::getSession()["user_firstname"],
            "adminPostsList" => self::getList("Rehor\Myblog\\entities\Post")
        ]);
    }

    public static function showOnePost(string $uid): void
    {
        if (SessionRepository::validateSession()) {
            self::$renderData["firstname"] = SessionRepository::getSession()["user_firstname"];
        }

        $currentPost = DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\Post", [ "uid" => $uid ]);

        if (!is_null($currentPost)) {
            self::$renderData = [
                "firstname" => SessionRepository::getSession()["user_firstname"],
                "uid" => $uid,
                "title" => $currentPost->title,
                "author" => $currentPost->author,
                "text" => $currentPost->text
            ];
        } else {
            self::$renderData = [
                "firstname" => SessionRepository::getSession()["user_firstname"],
                "error" => "No post found!"
            ];
        }

        self::show("admin/admin-posts/admin-post.php", self::$renderData);
    }

    public static function createPosts(): void
    {
        if (SessionRepository::validateSession()) {
            self::$renderData["firstname"] = SessionRepository::getSession()["user_firstname"];
        }

        $request = DBConnectorFlightRepository::requestConnector();

        if (count($request)) {
            
            if (self::validateRequestData($request)) {
                
                try {
                    $newPost = new Post();
                    $newPost->title = $request["title"];
                    $newPost->author = $request["author"];
                    $newPost->text = $request["text"];
                    
                    DBConnectorDoctrineRepository::updateConnector(DBController::getDBName(), $newPost);
                    
                    header("Location: /admin/posts");
                    exit();
                
                } catch(\Exception $e) {
                    echo $e->getMessage();
                    exit(1);
                }
            } else {
                self::$renderData = [
                    "firstname" => SessionRepository::getSession()["user_firstname"],
                    "error" => "Imcomplete post data provided! Please fill all the fields and try once again"
                ];
            }
        }

        self::show("admin/admin-posts/admin-posts-create.php", self::$renderData);
    }

    public static function updatePosts(string $uid): void
    {
        $request = DBConnectorFlightRepository::requestConnector();
        
        $postToUpdate = DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\Post", [ "uid" => $uid ]);
        
        if (count($request)) {

            if (self::validateRequestData($request)) {
                
                try {
                    $postToUpdate->title = $request["title"];
                    $postToUpdate->author = $request["author"];
                    $postToUpdate->text = $request["text"];
                    
                    DBConnectorDoctrineRepository::updateConnector(DBController::getDBName(), $postToUpdate);
                    
                    header("Location: /admin/posts");
                    exit();
                
                } catch(\Exception $e) {
                    echo $e->getMessage();
                    exit(1);
                }
            } else {
                self::$renderData = [
                    "firstname" => SessionRepository::getSession()["user_firstname"],
                    "error" => "Imcomplete post data provided! Please fill all the fields and try once again"
                ];
            }
        }

        if (SessionRepository::validateSession()) {
            self::$renderData["firstname"] = SessionRepository::getSession()["user_firstname"];
            
            if (!is_null($postToUpdate)) {
                self::$renderData = [
                    "firstname" => SessionRepository::getSession()["user_firstname"],
                    "uid" => $uid,
                    "title" => $postToUpdate->title,
                    "author" => $postToUpdate->author,
                    "text" => $postToUpdate->text
                ];
            } else {
                self::$renderData = [
                    "firstname" => SessionRepository::getSession()["user_firstname"],
                    "error" => "No post found!"
                ];
            }
        }

        self::show("admin/admin-posts/admin-posts-update.php", self::$renderData);
    }

    public static function deletePosts(string $uid): void
    {
        $request = DBConnectorFlightRepository::requestConnector();

        $postToDelete = DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\Post", [ "uid" => $uid ]);
        
        if (self::validateRequestData($request)) {    
            
            try {
                DBConnectorDoctrineRepository::deleteConnector(DBController::getDBName(), $postToDelete);

                header("Location: /admin/posts");
                exit();

            } catch(\Exception $e) {
                echo $e->getMessage();
                exit(1);
            }
        }

        if (SessionRepository::validateSession()) {
            self::$renderData["firstname"] = SessionRepository::getSession()["user_firstname"];

            if (!is_null($postToDelete)) {
                self::$renderData = [
                    "firstname" => SessionRepository::getSession()["user_firstname"],
                    "uid" => $uid,
                    "title" => $postToDelete->title,
                    "author" => $postToDelete->author,
                    "text" => $postToDelete->text
                ];
            } else {
                self::$renderData = [
                    "firstname" => SessionRepository::getSession()["user_firstname"],
                    "error" => "No post found!"
                ];
            }
        }
        
        self::show("admin/admin-posts/admin-posts-delete.php", self::$renderData);
    }
}