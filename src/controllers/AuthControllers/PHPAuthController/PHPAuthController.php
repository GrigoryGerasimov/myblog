<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AuthControllers\PHPAuthController;

use Rehor\Myblog\controllers\AuthControllers\PHPAuthController\interfaces\PHPAuthControllerInterface;
use Rehor\Myblog\repositories\AuthRepository\AuthRepository;

class PHPAuthController implements PHPAuthControllerInterface
{
    public static function auth(): void
    {
        AuthRepository::processAuthLogin($email, $password);
    }
    
    public static function register(): void
    {
        AuthRepository::processAuthRegistration($email, $password, $username);
    }
}