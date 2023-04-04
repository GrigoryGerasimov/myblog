<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\AuthRepository;

use Rehor\Myblog\repositories\AuthRepository\interfaces\AuthRepositoryInterface;
use Rehor\Myblog\models\Auths\DelightAuth\DelightAuth;
use Rehor\Myblog\models\Auths\NativeAuth\NativeAuth;

class AuthRepository implements AuthRepositoryInterface
{
    public static function processAuthRegistration(object $requestData, ?callable $fn = null)
    {
        return DelightAuth::triggerRegistration($requestData);
    }
    
    public static function processAuthLogin(?string $email = null, ?string $password = null): void
    {
        DelightAuth::triggerLogin($email, $password);
    }
    
    public static function processAuthLogout(): void
    {
        DelightAuth::triggerLogout();
    }
    
    public static function retrieveAuthUserData(): array
    {
        return array(
            "user_id" => DelightAuth::getAuthUserId(),
            "user_email" => DelightAuth::getAuthUserEmail(),
            "user_username" => DelightAuth::getAuthUsername()
        );
    }
}