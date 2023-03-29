<?php

declare(strict_types=1);

namespace Rehor\Myblog\routes\adminRoutes;

use Rehor\Myblog\controllers\AdminControllers\AdminController\AdminController;
use Rehor\Myblog\controllers\AdminControllers\AdminUsersController\AdminUsersController;
use Rehor\Myblog\controllers\AdminControllers\AdminPostsController\AdminPostsController;
use Rehor\Myblog\controllers\AdminControllers\AdminRolesController\AdminRolesController;

function getAdminRoutes(): array
{
    return [
        "/admin/auth/login" => fn() => AdminController::authAdmin(),
        "/admin/auth/logout" => fn() => AdminController::logoutAdmin(),
        "/admin" => fn() => AdminController::showAdmin(),
        
        "/admin/users" => fn() => AdminUsersController::showAdminUsers(),
        "/admin/users/create" => fn() => AdminUsersController::createUsers(),
        "/admin/users/@id/update" => function($id) { AdminUsersController::updateUsers($id); },
        "/admin/users/@id/delete" => function($id) { AdminUsersController::deleteUsers($id); },
        
        "/admin/posts" => fn() => AdminPostsController::showAdminPosts(),
        "/admin/posts/create" => fn() => AdminPostsController::createPosts(),
        "/admin/posts/@uid" => function($uid) { AdminPostsController::showOnePost($uid); },
        "/admin/posts/@id/update" => function($uid) { AdminPostsController::updatePosts($uid); },
        "/admin/posts/@id/delete" => function($uid) { AdminPostsController::deletePosts($uid); },

        "/admin/roles" => fn() => AdminRolesController::showAdminRoles(),
        "/admin/roles/create" => fn() => AdminRolesController::createRoles(),
        "/admin/roles/@id/update" => function($id) { AdminRolesController::updateRoles($id); },
        "/admin/roles/@id/delete" => function($id) { AdminRolesController::deleteRoles($id); }
    ];
}