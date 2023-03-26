<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\ProfileController;

use Rehor\Myblog\controllers\ProfileController\interfaces\ProfileControllerInterface;
use Rehor\Myblog\controllers\AuthController\AuthController;
use Rehor\Myblog\controllers\DBController\DBController;
use Rehor\Myblog\controllers\UserController\UserController;
use Rehor\Myblog\repositories\RendererRepository\RendererRepository;
use Rehor\Myblog\repositories\DBConnectorRepository\DBConnectorRepository;

class ProfileController implements ProfileControllerInterface
{
    protected static $renderData = [];
    
    public static function isAuthorized()
    {
        self::$renderData["isAuth"] = AuthController::checkSession();

        extract(AuthController::retrieveSession(), EXTR_SKIP);
        
        if (AuthController::checkSession()) {
            self::$renderData["firstname"] = $user_firstname;
            self::$renderData["lastname"] = $user_lastname;
            self::$renderData["email"] = $user_email;
        }
    }

    public static function showProfile()
    {        
        self::isAuthorized();
        
        if (AuthController::checkSession()) {

            RendererRepository::displayView("profile/profile.php", self::$renderData);
        } else {
            header("Location: /posts");
            exit();
        }
    }
    
    public static function updateProfile()
    {
        self::isAuthorized();

        $userToUpdate = DBConnectorRepository::requestConnectorDoctrine(DBController::getDBName(), "Rehor\Myblog\\entities\User")
        ->findOneBy([ "email" => self::$renderData["email"] ]);
        
        $requestData = DBConnectorRepository::requestConnectorFlight();
        
        if (!empty($requestData["firstname"]) && !empty($requestData["lastname"]) && !empty($requestData["email"])) {
            try {
                $userEmail = UserController::handleUserInput($requestData["email"]);
                
                $userToUpdate->firstname = $requestData["firstname"];
                $userToUpdate->lastname = $requestData["lastname"];
                $userToUpdate->email = $userEmail;
            
                DBConnectorRepository::updateConnectorDoctrine(DBController::getDBName(), $userToUpdate);
                
                AuthController::setSession([
                    "user_id" => $userToUpdate->id,
                    "user_email" => $userToUpdate->email,
                    "user_password" => $userToUpdate->password,
                    "user_firstname" => $userToUpdate->firstname,
                    "user_lastname" => $userToUpdate->lastname
                ]);
                
                self::$renderData["notification"] = "Your profile has been successfully updated";
            } catch(\Exception $e) {
                echo $e->getMessage();
            }
        }
        
        self::isAuthorized();

        if (self::$renderData["isAuth"]) {

            RendererRepository::displayView("profile/edit.php", self::$renderData);

        } else {
            header("Location: /posts");
            exit();
        }
    }
    
    public static function removeProfile()
    {
        self::isAuthorized();
        
        $userToDelete = DBConnectorRepository::requestConnectorDoctrine(DBController::getDBName(), "Rehor\Myblog\\entities\User")
        ->findOneBy([ "email" => self::$renderData["email"] ]);
        
        $requestData = DBConnectorRepository::requestConnectorFlight();
        
        if ($userToDelete &&
            !empty($requestData["firstname"]) &&
            !empty($requestData["lastname"]) && 
            !empty($requestData["email"])
        ) {
            try {
                DBConnectorRepository::deleteConnectorDoctrine(DBController::getDBName(), $userToDelete);
                
                AuthController::clearSession();
                
            } catch(\Exception $e) {
                echo $e->getMessage();
            }
        }
        
        self::isAuthorized();
        
        if (self::$renderData["isAuth"]) {
            
            RendererRepository::displayView("profile/delete.php", self::$renderData);
            
        } else {
            header("Location: /posts");
            exit();
        }
    }
}