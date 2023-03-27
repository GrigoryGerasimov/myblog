<?php

declare(strict_types=1);

namespace Rehor\Myblog\routes\adminRoutes;

use Rehor\Myblog\controllers\AdminController\AdminController;

function getAdminRoutes(): array
{
    return [
        "/admin/auth/login" => fn() => AdminController::authAdmin(),
        "/admin/auth/logout" => fn() => AdminController::logoutAdmin(),
        "/admin" => fn() => AdminController::showAdmin(),
        "/admin/posts" => fn() => AdminController::showAdminPosts(),
        "/admin/users" => fn() => AdminController::showAdminUsers(),
        "/admin/roles" => fn() => AdminController::showAdminRoles(),
    ];
}