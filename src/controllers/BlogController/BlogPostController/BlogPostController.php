<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\BlogController\BlogPostController;

use Rehor\Myblog\controllers\BlogController\BlogController;
use Rehor\Myblog\controllers\BlogController\traits\BlogControllerTrait;
use Rehor\Myblog\controllers\AuthController\AuthController;
use Rehor\Myblog\controllers\AdminControllers\AdminController\AdminController;
use Rehor\Myblog\controllers\DBController\DBController;
use Rehor\Myblog\controllers\FileController\FileController;
use Rehor\Myblog\controllers\UserController\UserController;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorDoctrineRepository\DBConnectorDoctrineRepository;
use Rehor\Myblog\repositories\PostRepository\PostRepository;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorFlightRepository\DBConnectorFlightRepository;
use Rehor\Myblog\repositories\RendererRepository\RendererRepository;

class BlogPostController extends BlogController
{
    use BlogControllerTrait;
    
    protected static $renderData = [];

    protected static function getCurrentUser(): array
    {
        return UserController::getCurrentAuthUser();
    }
    
    protected static function getRequestData(): object
    {
        return DBConnectorFlightRepository::requestConnector();
    }
    
    public static function isAuthorized(): void
    {
        self::$renderData["isAuth"] = AuthController::checkSession();
        self::$renderData["isAdmin"] = AdminController::checkAdmin();
        
        if (AuthController::checkSession()) {
            self::$renderData["firstname"] = AuthController::retrieveSession()["user_firstname"];
            self::$renderData["lastname"] = AuthController::retrieveSession()["user_lastname"];
        }
    }

    public static function getCurrentAuthor(): void
    {
        if (self::$renderData["isAuth"]) {
            self::$renderData["isAuthor"] = self::getCurrentUser()["user_username"];
        }
    }

    public static function isCurrentAuthor(): bool
    {
        if (self::$renderData["isAuthor"] && self::$renderData["author"]) {
            return self::$renderData["isAuthor"] === self::$renderData["author"];
        } else {
            return false;
        }
    }

    public static function removeCurrentAuthorFiles(?array $result)
    {
        if (!is_null($result)) {
            
            if (!empty($result["filepath"])) {
                $user = DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\User", [ "username" => $result["author"] ]);
                
                $userDir = str_contains($result["filepath"], "assets/uploads/") ?
                    "assets/uploads/".$user->id."/" :
                    substr($result["filepath"], 0, strpos($result["filepath"], "/", 0) + 1);
                    
                FileController::removeFiles($userDir);
            }
        }
    }

    public static function create()
    {
        if (!empty(self::getCurrentUser()["user_username"])) {
            self::$renderData["author"] = self::getCurrentUser()["user_username"];
        }

        $request = self::getRequestData();

        if (count($request)) {
            
            if (!empty(self::getCurrentUser()["user_username"])) {
                $request["author"] = self::getCurrentUser()["user_username"];
            } else {
                throw new \Exception("You cannot create any post unless you are authorized. Please sign in and try again");
            }
            
            if (self::validatePostData($request)) {
                
                try {
                    
                    if ($_FILES["file"]["name"]) {
                        try {
                            $newBlogFilePath = FileController::uploadFile("file");
                        } catch (\Exception $e) {
                            self::$renderData["error"] = $e->getMessage();
                        }
                    }

                    $request["filepath"] = isset($newBlogFilePath) ? $newBlogFilePath : null;
                    
                    PostRepository::createNewPost($request);

                    $createdNewPost = PostRepository::getOnePost(["title" => $request["title"]]);
                    $createdNewPostId = $createdNewPost["uid"];

                    header("Location: /posts/$createdNewPostId");
                    exit();

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
            $result = PostRepository::getOnePost(["uid" => $uid]);

            if (!is_null($result)) {
                self::$renderData = [
                    "uid" => $uid,
                    "title" => $result["title"],
                    "author" => $result["author"],
                    "text" => $result["text"],
                ];

                if (isset($result["filepath"]) && !empty($result["filepath"])) {
                    self::$renderData["filepath"] = $result["filepath"];
                }
            }
            
            self::isAuthorized();
            self::getCurrentAuthor();

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
        self::getCurrentAuthor();

        RendererRepository::displayView("posts/postsList.php", self::$renderData);
    }
    
    public static function update(string $uid)
    {
        if (!self::validatePostData(self::getRequestData())) {

            $result = PostRepository::getOnePost(["uid" => $uid]);
            
            if (!is_null($result)) {
                self::$renderData = [
                    "uid" => $uid,
                    "title" => $result["title"],
                    "author" => $result["author"],
                    "text" => $result["text"]
                ];
            }

            if (isset($result["filepath"]) && !empty($result["filepath"])) {
                self::$renderData["filepath"] = $result["filepath"];
            }

        } else {

            try {
                $result = PostRepository::getOnePost(["uid" => $uid]);

                self::removeCurrentAuthorFiles($result);

                if ($_FILES["file"]["name"]) {
                    try {
                        $newBlogFilePath = FileController::uploadFile("file");
                    } catch (\Exception $e) {
                        self::$renderData["error"] = $e->getMessage();
                    }
                }

                $request = self::getRequestData();
                $request["filepath"] = isset($newBlogFilePath) ? $newBlogFilePath : null;

                $updatedPost = PostRepository::updatePost(["uid" => $uid], $request);
                
                if (!is_null($updatedPost)) {
                    self::$renderData["uid"] = $updatedPost["uid"];
                    self::$renderData["title"] = $updatedPost["title"];
                    self::$renderData["author"] = $updatedPost["author"];
                    self::$renderData["text"] = $updatedPost["text"];
                    self::$renderData["filepath"] = $updatedPost["filepath"];
                }

                if (!isset(self::$renderData["error"]) || empty(self::$renderData["error"])) {
                    self::$renderData["notification"] = "Post successfully updated!";
                }


            } catch(\Exception $e) {
                self::handleException($e);
            }
        }
        
        self::isAuthorized();
        self::getCurrentAuthor();

        if (self::$renderData["isAuth"] && self::isCurrentAuthor()) {
            
            RendererRepository::displayView("posts/edit.php", self::$renderData);
            
        } else {
            header("Location: /posts/$uid");
            exit();
        }
    }
    
    public static function delete($uid)
    {
        $result = PostRepository::getOnePost(["uid" => $uid]);
        
        if (!is_null($result)) {
            self::$renderData = [
                "uid" => $uid,
                "title" => $result["title"],
                "author" => $result["author"],
                "text" => $result["text"],
                "filepath" => $result["filepath"]
            ];
        }
        
        if (self::validatePostData(self::getRequestData())) {
            try {
                self::removeCurrentAuthorFiles($result);

                PostRepository::deletePost(["uid" => $uid]);
                
                self::$renderData["notification"] = "Post successfully deleted!";

                header("Location: /posts");
                exit();

            } catch(\Exception $e) {
                self::handleException($e);
            }
        }
        
        self::isAuthorized();
        self::getCurrentAuthor();
        
        if (self::$renderData["isAuth"] && self::isCurrentAuthor()) {
            
            RendererRepository::displayView("posts/delete.php", self::$renderData);
            
        } else {
            header("Location: /posts/$uid");
            exit();
        }
    }
}