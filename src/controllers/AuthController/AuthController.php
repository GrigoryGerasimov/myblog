<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AuthController;

use Rehor\Myblog\controllers\AuthController\interfaces\AuthControllerInterface;
use Rehor\Myblog\repositories\SessionRepository\SessionRepository;

class AuthController implements AuthControllerInterface
{
    public static function auth()
    {
        $requestData = \Flight::request()->data;
        
        [
        "email" => $email,
        "password" => $password
        ] = $requestData;
        
        $user = $GLOBALS["entityManager"]->getRepository("Rehor\Myblog\\entities\User")->findOneBy([
            "email" => $email
        ]);
        
        $hashedPassword = md5($password);
        
        if (!empty($email) && !empty($password)) {

            if ($email === $user->email && $hashedPassword === $user->password) {
                self::setSession($user->id, $user->email, $user->password);

                header("Location: /posts");

                exit(1);
            } else {
                \Flight::view()->display("auth/login.php", [
                    "notification" => "Sign in failed! Your email or password is incorrect"
                ]);
            }
        }
    }
    
    public static function setSession(int $id, string $email, string $password)
    {
        SessionRepository::setSession([
            "user_id" => $id,
            "user_email" => $email,
            "user_password" => $password
        ]);
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
            exit(1);
        }
    }
}