<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Auths\DelightAuth\interfaces;

interface DelightAuthInterface
{
    public static function init(): object;
    
    public static function triggerRegistration(object $requestData): int;
    
    public static function triggerLogin(?string $email, ?string $password): void;
    
    public static function triggerLogout(): void;
    
    public static function getAuthUserId(): int;
    
    public static function getAuthUserEmail(): string;
    
    public static function getAuthUsername(): string;
    
    public static function isAdmin(): bool;
}