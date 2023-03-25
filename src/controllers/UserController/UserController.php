<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\UserController;

use Rehor\Myblog\controllers\UserController\interfaces\UserControllerInterface;
use Rehor\Myblog\controllers\UserController\traits\UserControllerTrait;
use Rehor\Myblog\controllers\AuthController\AuthController;
use Rehor\Myblog\entities\User;

class UserController implements UserControllerInterface
{
    use UserControllerTrait;

    public static function login()
    {
        \Flight::view()->display("auth/login.php", [
            "isAuth" => AuthController::checkSession()
        ]);
    }
    
    public static function register()
    {
        $isRegistered = false;
        
        $requestData = \Flight::request()->data;
        
        if (!empty($requestData["email"] && !empty($requestData["password"]))) {
            $userEmail = self::handleUserInput($requestData["email"]);
            $userPassword = self::handleUserInput($requestData["password"]);
        
            $registeredUser = $GLOBALS["entityManager"]->getRepository("Rehor\Myblog\\entities\User")->findOneBy([
                "email" => $userEmail
            ]);        
        
            if (is_null($registeredUser)) {
                $newUser = new User();
                $newUser->email = $userEmail;
                $newUser->password = md5($userPassword);
            
                $GLOBALS["entityManager"]->persist($newUser);
                $GLOBALS["entityManager"]->flush();
                
                $createdUser = $GLOBALS["entityManager"]->getRepository("Rehor\Myblog\\entities\User")->findOneBy([
                    "email" => $userEmail
                ]);
                if (!is_null($createdUser)) {
                    AuthController::setSession($createdUser->id, $createdUser->email, $createdUser->password);
                    header("Location: /posts");
                    exit(1);
                }
            } else {
                $isRegistered = true;
            }
        }

        \Flight::view()->display("auth/register.php", [
            "isRegistered" => $isRegistered,
            "isAuth" => AuthController::checkSession()
        ]);
    }
}