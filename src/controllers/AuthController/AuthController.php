<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AuthController;

use Rehor\Myblog\controllers\AuthController\interfaces\AuthControllerInterface;
use Rehor\Myblog\controllers\UserController\UserController;
use Rehor\Myblog\controllers\DBController\DBController;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorFlightRepository\DBConnectorFlightRepository;
use Rehor\Myblog\repositories\AuthRepository\AuthRepository;
use Rehor\Myblog\repositories\RendererRepository\RendererRepository;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorDoctrineRepository\DBConnectorDoctrineRepository;
use Rehor\Myblog\entities\User;

final class AuthController implements AuthControllerInterface
{
    public static function auth(): void
    {
        [
        "email" => $email,
        "password" => $password,
        "rememberme" => $remember
        ] = DBConnectorFlightRepository::requestConnector();
        
        
        try {
            
            AuthRepository::processAuthLogin($email, $password, $remember);
            
            header("Location: /posts");
            exit();
            
        } catch (\Exception $e) {
            
            RendererRepository::displayView("auth/login.php", [
                "error" => $e->getMessage()
            ]);
        }
    }
    
    public static function authCheck(): void
    {
        $successNotification = $errorNotification = "";
        
        try {
            
            $registeredEmailList = AuthRepository::verifyAuthRegisteredMail($_GET["selector"], $_GET["token"]);
            
            $successNotification = "The registered email id $registeredEmailList[1] has been successfully verified. You can now sign in with your credentials";
            
        } catch (\Exception $e) {
            
            $errorNotification = $e->getMessage();
            
        }
        
        RendererRepository::displayView("auth/login.php", [
            "success" => $successNotification,
            "error" => $errorNotification
        ]);
    }
    
    public static function triggerPasswordReset(): void
    {
        $successNotification = $errorNotification = "";
        $requestData = DBConnectorFlightRepository::requestConnector();
        
        if (count($requestData)) {
            
            if (isset($requestData["password-request-email"])) {
                
                $requestingUser = DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\User", [ "email" => $requestData["password-request-email"] ]);
                
                if (!is_null($requestingUser)) {
                    
                    try {
                        
                        AuthRepository::triggerForgottenPasswordReset($requestData["password-request-email"]);
                        
                        $successNotification = "The password reset link has just been sent to the provided email address";
                    
                    } catch (\Exception $e) {
                        
                        $errorNotification = $e->getMessage();
                    
                    }
                    
                } else {
                    
                    $errorNotification = "The email id has not been registered";
                
                }
            } 
        }
        
        RendererRepository::displayView("auth/password.php", [
            "success" => $successNotification,
            "error" => $errorNotification
        ]);
    }
    
    public static function resetPassword(): void
    {
        $successNotification = $errorNotification = "";
        $requestData = DBConnectorFlightRepository::requestConnector();
        
        if (count($requestData)) {
            
            if (isset($requestData["new-password"]) && isset($requestData["confirm-new-password"]) && $requestData["new-password"] === $requestData["confirm-new-password"]) {
                
                try {
                    
                    UserController::handlePasswordCheck($requestData["new-password"]);
                    
                    $requestData["new-password"] = UserController::handleUserInput($requestData["new-password"]);
                    
                    AuthRepository::processForgottenPasswordReset($_GET["selector"], $_GET["token"], $requestData["new-password"]);
                    
                    $successNotification = "Your password has been successfully reset";
                
                } catch (\Exception $e) {
                    
                    $errorNotification = $e->getMessage();
                
                }
            
            } else {
                
                $errorNotification = "Your new password could not be reset. Please try once again";
            
            }
        }
        
        RendererRepository::displayView("auth/password-reset.php", [
            "success" => $successNotification,
            "error" => $errorNotification
        ]);
    }
    
    public static function logout(): void
    {
        try {
            
            AuthRepository::processAuthLogout();
            
            header("Location: /login");
            exit();
            
        } catch (\Exception $e) {
            
            RendererRepository::displayView("utils/logout-failed.php", [
                "notification" => $e->getMessage()
            ]);
            
        }
    }
}