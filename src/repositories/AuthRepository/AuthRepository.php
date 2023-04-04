<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\AuthRepository;

use Rehor\Myblog\repositories\AuthRepository\interfaces\AuthRepositoryInterface;
use Rehor\Myblog\models\Auth\Auth;

class AuthRepository implements AuthRepositoryInterface
{
    public static function initAuth(string $dbName): object
    {
        return Auth::init($dbName);
    }
    
    public static function processAuthRegistration(string $email, string $password, string $username, ?callable $fn = null): void
    {
        Auth::triggerRegistration($email, $password, $username, $fn);
    }
    
    public static function processAuthLogin(string $email, string $password): void
    {
        Auth::triggerLogin($email, $password);
    }
}