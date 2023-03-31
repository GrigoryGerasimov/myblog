<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\UserController\interfaces;

interface UserControllerInterface
{
    public static function login(): void;
    
    public static function register(): void;

    public static function getCurrentAuthUser(): array;
}