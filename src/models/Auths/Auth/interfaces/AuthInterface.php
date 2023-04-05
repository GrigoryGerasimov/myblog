<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Auths\Auth\interfaces;

interface AuthInterface
{
    public static function triggerRegistration(object $requestData);
    
    public static function triggerLogin(?string $email = null, ?string $password = null): void;
    
    public static function triggerLogout(): void;
    
    public static function getAuthUserId(): ?int;
    
    public static function getAuthUserEmail(): ?string;
    
    public static function getAuthUsername(): ?string;
    
    public static function isAdmin(): bool;
    
    public static function createUserAsAdmin(): void;
}
