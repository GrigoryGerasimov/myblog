<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AuthController\interfaces;

interface AuthControllerInterface
{
    public static function auth();
    
    public static function setSession(int $id, string $email, string $password);
    
    public static function clearSession();
    
    public static function logout();
}