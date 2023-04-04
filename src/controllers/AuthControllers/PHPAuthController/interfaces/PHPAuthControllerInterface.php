<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AuthControllers\PHPAuthController\interfaces;

interface PHPAuthControllerInterface
{
    public static function auth(): void;
    
    public static function register(): void;
}