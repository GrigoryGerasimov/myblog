<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\ProfileController;

use Rehor\Myblog\controllers\ProfileController\interfaces\ProfileControllerInterface;
use Rehor\Myblog\controllers\DBController\DBController;
use Rehor\Myblog\controllers\UserController\UserController;
use Rehor\Myblog\controllers\FileController\FileController;
use Rehor\Myblog\repositories\RendererRepository\RendererRepository;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorFlightRepository\DBConnectorFlightRepository;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorDoctrineRepository\DBConnectorDoctrineRepository;
use Rehor\Myblog\repositories\SessionRepository\SessionRepository;
use Rehor\Myblog\repositories\AuthRepository\AuthRepository;

final class ProfileController implements ProfileControllerInterface
{
    protected static $renderData = [];
    
    public static function isAuthorized()
    {
        self::$renderData["isAuth"] = AuthRepository::verifyAuthStatus();

        extract(AuthRepository::retrieveAuthUserData(), EXTR_SKIP);
        
        if (!empty(self::$renderData["isAuth"])) {
            self::$renderData["username"] = $user_username;
            self::$renderData["firstname"] = $user_firstname;
            self::$renderData["lastname"] = $user_lastname;
            self::$renderData["email"] = $user_email;
        }
    }

    public static function showProfile()
    {        
        self::isAuthorized();
        
        if (self::$renderData["isAuth"]) {
            
            $currentUser = DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\User", [ "username" => self::$renderData["username"] ]);
            
            if (!is_null($currentUser->filepath)) {
                self::$renderData["filepath"] = $currentUser->filepath;
            }
            
            RendererRepository::displayView("profile/profile.php", self::$renderData);
        
        } else {
            
            header("Location: /posts");
            exit();
            
        }
    }
    
    public static function updateProfile()
    {
        self::isAuthorized();

        if (self::$renderData["isAuth"]) {
            
            $userToUpdate = DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\User", [ "email" => self::$renderData["email"] ]);
        
            if (!is_null($userToUpdate->filepath)) {
                self::$renderData["filepath"] = $userToUpdate->filepath;
            }

            $requestData = DBConnectorFlightRepository::requestConnector();
        
            if (!empty($requestData["username"]) && !empty($requestData["firstname"]) && !empty($requestData["lastname"]) && !empty($requestData["email"])) {

                try {
                    if ($_FILES["file"]["name"]) {
                        try {
                            $newUserFilePath = FileController::uploadFile("file");
                        } catch (\Exception $e) {
                            self::$renderData["error"] = $e->getMessage();
                        }
                    }
                    $requestData["filepath"] = isset($newUserFilePath) ? $newUserFilePath : null;


                    $userEmail = UserController::handleUserInput($requestData["email"]);
                
                    $userToUpdate->username = $requestData["username"];
                    $userToUpdate->firstname = $requestData["firstname"];
                    $userToUpdate->lastname = $requestData["lastname"];
                    $userToUpdate->filepath = $requestData["filepath"];
                    $userToUpdate->email = $userEmail;
            
                    DBConnectorDoctrineRepository::updateConnector(DBController::getDBName(), $userToUpdate);

                    $updatedUser = DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\User", [ "username" => self::$renderData["username"] ]);
                    
                    if (!is_null($updatedUser->filepath)) {
                        self::$renderData["filepath"] = $updatedUser->filepath;
                    }
                
                    SessionRepository::setSession([
                        "user_id" => $updatedUser->id,
                        "user_email" => $updatedUser->email,
                        "user_password" => $updatedUser->password,
                        "user_firstname" => $updatedUser->firstname,
                        "user_lastname" => $updatedUser->lastname
                    ]);
                
                    if (!isset(self::$renderData["error"]) || empty(self::$renderData["error"])) {
                        self::$renderData["notification"] = "Your profile has been successfully updated";

                        header("Location: /profile");
                        exit();
                    }

                } catch(\Exception $e) {
                    echo $e->getMessage();
                }
            }
            
            self::isAuthorized();

            RendererRepository::displayView("profile/edit.php", self::$renderData);

        } else {
            header("Location: /posts");
            exit();
        }
    }
    
    public static function removeProfile()
    {
        self::isAuthorized();
        
        if (self::$renderData["isAuth"]) {
            
            $userToDelete = DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\User", [ "email" => self::$renderData["email"] ]);
        
            if (!is_null($userToDelete->filepath)) {
                self::$renderData["filepath"] = $userToDelete->filepath;
            }

            $requestData = DBConnectorFlightRepository::requestConnector();
        
            if ($userToDelete &&
                !empty($requestData["firstname"]) &&
                !empty($requestData["lastname"]) && 
                !empty($requestData["email"])
            ) {
                try {
                    if (!empty(self::$renderData["filepath"])) {
                        $userDir = str_contains(self::$renderData["filepath"], "assets/uploads/") ?
                            "assets/uploads/".$userToDelete->id."/" :
                            substr(self::$renderData["filepath"], 0, strpos(self::$renderData["filepath"], "/", 0) + 1);
                                
                        FileController::removeFiles($userDir);
                    }

                    DBConnectorDoctrineRepository::deleteConnector(DBController::getDBName(), $userToDelete);
                
                    SessionRepository::unsetSession();

                    header("Location: /login");
                    exit();
                
                } catch(\Exception $e) {
                    echo $e->getMessage();
                }
            }
        
            self::isAuthorized();
        
            RendererRepository::displayView("profile/delete.php", self::$renderData);
            
        } else {
            header("Location: /posts");
            exit();
        }
    }
}