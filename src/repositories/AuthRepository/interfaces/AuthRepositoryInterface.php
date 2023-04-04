<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\AuthRepository\interfaces;

interface AuthRepositoryInterface
{
    public static function processAuthRegistration(object $requestData, ?callable $fn);
    
    public static function processAuthLogin(?string $email = null, ?string $password = null): void;
    
    public static function processAuthLogout(): void;
    
    public static function retrieveAuthUserData(): array;
}