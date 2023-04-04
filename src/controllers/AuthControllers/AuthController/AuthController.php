<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AuthControllers\AuthController;

use Rehor\Myblog\controllers\AuthControllers\AuthController\interfaces\AuthControllerInterface;
use Rehor\Myblog\controllers\DBController\DBController;
use Rehor\Myblog\repositories\SessionRepository\SessionRepository;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorFlightRepository\DBConnectorFlightRepository;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorDoctrineRepository\DBConnectorDoctrineRepository;
use Rehor\Myblog\repositories\RendererRepository\RendererRepository;

class AuthController implements AuthControllerInterface
{
    public static function auth()
    {
        [
        "email" => $email,
        "password" => $password
        ] = DBConnectorFlightRepository::requestConnector();
        
        $user = DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\User", [ "email" => $email ]);
        
        if (!empty($email) && !empty($password)) {

            $hashedPassword = md5($password);
            
            $sessionData = [
                "user_id" => $user->id,
                "user_email" => $user->email,
                "user_password" => $user->password,
                "user_username" => $user->username,
                "user_firstname" => $user->firstname,
                "user_lastname" => $user->lastname,
                "user_role" => $user->role
            ];

            if (!is_null($user) && $email === $user->email && $hashedPassword === $user->password) {
                
                self::setSession($sessionData);

                header("Location: /posts");

                exit();
            } else {
                RendererRepository::displayView("auth/login.php", [
                    "notification" => "Sign in failed! Your email or password is incorrect"
                ]);
            }
        } else {
            header("Location: /login");
            exit();
        }
    }
    
    public static function setSession(array $sessionData)
    {
        SessionRepository::setSession($sessionData);
    }
    
    public static function retrieveSession()
    {
        return SessionRepository::getSession();
    }
    
    public static function clearSession()
    {
        SessionRepository::unsetSession();
    }
    
    public static function checkSession()
    {
        return SessionRepository::validateSession();
    }
    
    public static function logout()
    {
        self::clearSession();
        
        if (!self::checkSession()) {
            header("Location: /login");
            exit();
        }
    }
}