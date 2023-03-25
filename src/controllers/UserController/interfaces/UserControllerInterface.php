<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\UserController\interfaces;

interface UserControllerInterface
{
    public static function login();
    
    public static function register();
}