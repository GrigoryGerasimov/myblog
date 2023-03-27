<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\UserController;

use Rehor\Myblog\controllers\UserController\interfaces\UserControllerInterface;
use Rehor\Myblog\controllers\UserController\traits\UserControllerTrait;
use Rehor\Myblog\controllers\AuthController\AuthController;
use Rehor\Myblog\controllers\DBController\DBController;
use Rehor\Myblog\controllers\AdminController\AdminController;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorFlightRepository\DBConnectorFlightRepository;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorDoctrineRepository\DBConnectorDoctrineRepository;
use Rehor\Myblog\repositories\RendererRepository\RendererRepository;
use Rehor\Myblog\entities\User;

class UserController implements UserControllerInterface
{
    use UserControllerTrait;

    public static function login()
    {
        RendererRepository::displayView("auth/login.php", [
            "isAuth" => AuthController::checkSession(),
            "isAdmin" => AdminController::checkAdmin()
        ]);
    }
    
    public static function register()
    {
        $isRegistered = false;
        
        $requestData = DBConnectorFlightRepository::requestConnector();
        
        if (!empty($requestData["email"]) && !empty($requestData["password"])) {
            $userEmail = self::handleUserInput($requestData["email"]);
            $userPassword = self::handleUserInput($requestData["password"]);
        
            $registeredUser = DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\User", [ "email" => $userEmail ]); 
        
            if (is_null($registeredUser)) {
                $newUser = new User();
                $newUser->email = $userEmail;
                $newUser->password = md5($userPassword);
                $newUser->firstname = $requestData["firstname"];
                $newUser->lastname = $requestData["lastname"];
                $newUser->role = $requestData["role"];
            
                DBConnectorDoctrineRepository::updateConnector(DBController::getDBName(), $newUser);
                
                $createdUser = DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\User", [ "email" => $userEmail ]);

                if (!is_null($createdUser)) {

                    AuthController::setSession([
                       "user_id" => $createdUser->id,
                       "user_email" => $createdUser->email,
                       "user_password" => $createdUser->password,
                       "user_firstname" => $createdUser->firstname,
                       "user_lastname" => $createdUser->lastname
                    ]);

                    header("Location: /posts");
                    exit();
                }
            } else {
                $isRegistered = true;
            }
        }

        RendererRepository::displayView("auth/register.php", [
            "isRegistered" => $isRegistered,
            "isAuth" => AuthController::checkSession()
        ]);
    }
}