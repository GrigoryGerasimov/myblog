<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Auths\Auth;

use Rehor\Myblog\models\Auths\Auth\interfaces\AuthInterface;

abstract class Auth implements AuthInterface
{
    abstract public static function triggerRegistration(object $requestData);
    
    abstract public static function triggerLogin(?string $email = null, ?string $password = null): void;
    
    abstract public static function triggerLogout(): void;
    
    abstract public static function getAuthUserId(): ?int;
    
    abstract public static function getAuthUserEmail(): ?string;
    
    abstract public static function getAuthUsername(): ?string;
    
    abstract public static function isAdmin(): bool;
    
    abstract public static function createUserAsAdmin(): void;
}