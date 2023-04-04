<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\AuthRepository\interfaces;

interface AuthRepositoryInterface
{
    public static function initAuth(string $dbName): object;
    
    public static function processAuthRegistration(string $email, string $password, string $username, ?callable $fn = null): void;
    
    public static function processAuthLogin(string $email, string $password): void;
}