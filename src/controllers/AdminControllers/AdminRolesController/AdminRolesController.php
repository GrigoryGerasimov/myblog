<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AdminControllers\AdminRolesController;

use Rehor\Myblog\controllers\AdminControllers\AdminRolesController\interfaces\AdminRolesControllerInterface;
use Rehor\Myblog\controllers\AdminControllers\AdminController\AdminController;
use Rehor\Myblog\controllers\AuthController\AuthController;

class AdminRolesController extends AdminController implements AdminRolesControllerInterface
{
    public static function showAdminRoles(): void
    {
        self::show("admin/admin-roles/admin-roles.php", [
            "firstname" => AuthController::retrieveSession()["user_firstname"],
            "adminRolesList" => self::getList("Rehor\Myblog\\entities\Role")
        ]);
    }

    public static function createRoles(): void
    {

    }

    public static function updateRoles(string $id): void
    {

    }

    public static function deleteRoles(string $id): void
    {

    }
}