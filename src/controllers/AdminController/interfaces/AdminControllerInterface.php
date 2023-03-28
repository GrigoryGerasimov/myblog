<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AdminController\interfaces;

interface AdminControllerInterface
{
    public static function authAdmin(): void;

    public static function showAdmin(): void;

    public static function checkAdmin(): bool;

    public static function preventAdmin(): void;

    public static function logoutAdmin(): void;

    public static function showAdminPosts(): void;

    public static function showAdminUsers(): void;

    public static function showAdminRoles(): void;

    public static function createUsers(): void;

    public static function updateUsers(string $id): void;

    public static function deleteUsers(string $id): void;
}