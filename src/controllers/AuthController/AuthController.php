<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AuthController;

use Rehor\Myblog\controllers\AuthController\interfaces\AuthControllerInterface;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorFlightRepository\DBConnectorFlightRepository;
use Rehor\Myblog\repositories\AuthRepository\AuthRepository;
use Rehor\Myblog\repositories\RendererRepository\RendererRepository;

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
                "notification" => $e->getMessage()
            ]);
        }
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