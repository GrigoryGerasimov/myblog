<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AuthController\interfaces;

interface AuthControllerInterface
{
    public static function auth(): void;
    
    public static function logout(): void;
}