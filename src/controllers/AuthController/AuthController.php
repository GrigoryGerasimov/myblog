<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AuthController;

use Rehor\Myblog\controllers\AuthController\interfaces\AuthControllerInterface;
use Rehor\Myblog\controllers\DBController\DBController;
use Rehor\Myblog\repositories\SessionRepository\SessionRepository;
use Rehor\Myblog\repositories\DBConnectorRepository\DBConnectorRepository;

class AuthController implements AuthControllerInterface
{
    public static function auth()
    {
        [
        "email" => $email,
        "password" => $password
        ] = DBConnectorRepository::requestConnectorFlight();
        
        $user = DBConnectorRepository::requestConnectorDoctrine(DBController::getDBName(), "Rehor\Myblog\\entities\User")->findOneBy([
            "email" => $email
        ]);
        
        if (!empty($email) && !empty($password)) {

            $hashedPassword = md5($password);

            if (!is_null($user) && $email === $user->email && $hashedPassword === $user->password) {
                self::setSession([
                    "user_id" => $user->id,
                    "user_email" => $user->email,
                    "user_password" => $user->password,
                    "user_firstname" => $user->firstname,
                    "user_lastname" => $user->lastname
                ]);

                header("Location: /posts");

                exit();
            } else {
                \Flight::view()->display("auth/login.php", [
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