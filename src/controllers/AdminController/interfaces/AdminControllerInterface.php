<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AdminController\interfaces;

interface AdminControllerInterface
{
    public static function authAdmin();

    public static function showAdmin();

    public static function checkAdmin();

    public static function preventAdmin();

    public static function logoutAdmin();

    public static function showAdminPosts();

    public static function showAdminUsers();

    public static function showAdminRoles();
}