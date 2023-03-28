<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AdminControllers\AdminUsersController\interfaces;

use Rehor\Myblog\controllers\AdminControllers\AdminController\interfaces\AdminControllerInterface;

interface AdminUsersControllerInterface extends AdminControllerInterface
{
    public static function showAdminUsers(): void;

    public static function createUsers(): void;

    public static function updateUsers(string $id): void;

    public static function deleteUsers(string $id): void;
}