<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AdminControllers\AdminController\interfaces;

interface AdminControllerInterface
{
    public static function authAdmin(): void;

    public static function showAdmin(): void;

    public static function checkAdmin(): bool;

    public static function preventAdmin(): void;

    public static function logoutAdmin(): void;
}