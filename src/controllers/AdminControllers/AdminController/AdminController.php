<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AdminControllers\AdminController;

use Rehor\Myblog\controllers\AdminControllers\AdminController\interfaces\AdminControllerInterface;
use Rehor\Myblog\controllers\AuthControllers\AuthController\AuthController;
use Rehor\Myblog\controllers\DBController\DBController;
use Rehor\Myblog\controllers\AdminControllers\AdminController\traits\AdminControllerTrait;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorDoctrineRepository\DBConnectorDoctrineRepository;
use Rehor\Myblog\repositories\RendererRepository\RendererRepository;

class AdminController implements AdminControllerInterface
{
    use AdminControllerTrait;

    protected static $renderData = [];

    public static function authAdmin(): void
    {
        if (AuthController::checkSession() && self::checkAdmin()) {
            header("Location: /admin");
            exit();
        } else {
            header("Location: /access-denied");
            exit(1);
        }
    }

    public static function showAdmin(): void
    {
        if (AuthController::checkSession()) {
            self::$renderData["firstname"] = AuthController::retrieveSession()["user_firstname"];
        }

        self::show("admin/admin.php", self::$renderData);
    }

    public static function checkAdmin(): bool
    {
        $currentSession = AuthController::retrieveSession();

        if (count($currentSession) !== 0) {
         
            $userRole = $currentSession["user_role"];
            
            $role = DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\Role", [ "id" => $userRole ]);
            $sessionData["isAdmin"] = $role->permission;
            
            return $role->permission;
        }

        return false;
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