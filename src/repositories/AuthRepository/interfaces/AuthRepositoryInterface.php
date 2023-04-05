<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\AuthRepository\interfaces;

interface AuthRepositoryInterface
{
    public static function processAuthRegistration(object $requestData);
    
    public static function processAuthLogin(?string $email, ?string $password, ?string $remmeber): void;
    
    public static function processAuthLogout(): void;
    
    public static function retrieveAuthUserData(): array;
    
    public static function verifyAdminStatus(): bool;
    
    public static function verifyAuthStatus(): bool;
    
    public static function processUserCreationAsAdmin(): void;
}