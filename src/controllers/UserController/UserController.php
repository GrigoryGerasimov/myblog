<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\UserController;

use Rehor\Myblog\controllers\UserController\interfaces\UserControllerInterface;
use Rehor\Myblog\controllers\UserController\traits\UserControllerTrait;
use Rehor\Myblog\controllers\DBController\DBController;
use Rehor\Myblog\controllers\AdminControllers\AdminController\AdminController;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorFlightRepository\DBConnectorFlightRepository;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorDoctrineRepository\DBConnectorDoctrineRepository;
use Rehor\Myblog\repositories\RendererRepository\RendererRepository;
use Rehor\Myblog\repositories\SessionRepository\SessionRepository;
use Rehor\Myblog\repositories\AuthRepository\AuthRepository;
use Rehor\Myblog\entities\User;

final class UserController implements UserControllerInterface
{
    use UserControllerTrait;

    public static function login(): void
    {
        RendererRepository::displayView("auth/login.php", [
            "isAuth" => AuthRepository::verifyAuthStatus(),
            "isAdmin" => AdminController::checkAdmin()
        ]);
    }
    
    public static function register(): void
    {
        $isRegistered = false;
        $notification = "";
        
        $requestData = DBConnectorFlightRepository::requestConnector();
        
        if (!empty($requestData["username"]) && !empty($requestData["email"]) && !empty($requestData["password"])) {
            
            $requestData["email"] = self::handleUserInput($requestData["email"]);
            $requestData["password"] = self::handleUserInput($requestData["password"]);
            $requestData["username"] = self::handleUserInput($requestData["username"]);
        
            $registeredUser = DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\User", [ "email" => $requestData["email"] ]); 
        
            if (is_null($registeredUser)) {
                
                try {
                    
                    $registeredUserId = AuthRepository::processAuthRegistration($requestData);
                    
                    if (!is_null($registeredUserId)) {
                        
                        $createdUser = DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\User", [ "id" => $registeredUserId ]);
                        
                        if (!is_null($createdUser)) {
                            
                            AuthRepository::processAuthLogin($createdUser->email, $requestData["password"]);
                            
                        }
                        
                        header("Location: /posts");
                        exit();
                        
                    }
                    
                } catch (\Exception $e) {
                    
                    $notification = $e->getMessage();
                }

            } else {
                
                $isRegistered = true;
                
            }
        }

        RendererRepository::displayView("auth/register.php", [
            "notification" => $notification,
            "isRegistered" => $isRegistered,
            "isAuth" => AuthRepository::verifyAuthStatus()
        ]);
    }

    public static function getCurrentAuthUser(): array
    {
        return AuthRepository::retrieveAuthUserData();
    }
}