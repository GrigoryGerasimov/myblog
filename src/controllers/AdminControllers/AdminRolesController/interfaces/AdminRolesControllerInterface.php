<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AdminControllers\AdminRolesController\interfaces;

use Rehor\Myblog\controllers\AdminControllers\AdminController\interfaces\AdminControllerInterface;

interface AdminRolesControllerInterface extends AdminControllerInterface
{
    public static function showAdminRoles(): void;

    public static function createRoles(): void;

    public static function updateRoles(string $id): void;

    public static function deleteRoles(string $id): void;
}