<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Auth\interfaces;

interface AuthInterface
{
    public static function init(): object;
    
    public static function triggerRegistration(string $email, string $password, string $username, callable $fn): void;
    
    public static function triggerLogin(string $email, string $password): void;
}