<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AuthControllers\AuthController\interfaces;

interface AuthControllerInterface
{
    public static function auth();
    
    public static function setSession(array $sessionData);
    
    public static function retrieveSession();
    
    public static function clearSession();
    
    public static function logout();
}