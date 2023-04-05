<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AdminControllers\AdminController;

use Rehor\Myblog\controllers\AdminControllers\AdminController\interfaces\AdminControllerInterface;
use Rehor\Myblog\controllers\AuthController\AuthController;
use Rehor\Myblog\controllers\DBController\DBController;
use Rehor\Myblog\controllers\AdminControllers\AdminController\traits\AdminControllerTrait;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorDoctrineRepository\DBConnectorDoctrineRepository;
use Rehor\Myblog\repositories\RendererRepository\RendererRepository;
use Rehor\Myblog\repositories\SessionRepository\SessionRepository;
use Rehor\Myblog\repositories\AuthRepository\AuthRepository;

abstract class AdminController implements AdminControllerInterface
{
    use AdminControllerTrait;

    protected static $renderData = [];

    public static function authAdmin(): void
    {
        if (AuthRepository::verifyAuthStatus() && self::checkAdmin()) {
            header("Location: /admin");
            exit();
        } else {
            header("Location: /access-denied");
            exit(1);
        }
    }

    public static function showAdmin(): void
    {
        if (AuthRepository::verifyAuthStatus()) {
            self::$renderData["firstname"] = AuthRepository::retrieveAuthUserData()["user_firstname"];
        }

        self::show("admin/admin.php", self::$renderData);
    }

    public static function checkAdmin(): bool
    {
        return AuthRepository::verifyAdminStatus();
    }

    public static function preventAdmin(): void
    {
        RendererRepository::displayView("utils/access-denied.php", []);
        http_response_code(403);
        exit(1);
    }

    public static function logoutAdmin(): void
    {
        AuthController::logout();
    }
}