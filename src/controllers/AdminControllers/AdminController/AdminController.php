<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AdminControllers\AdminController;

use Rehor\Myblog\controllers\AdminControllers\AdminController\interfaces\AdminControllerInterface;
use Rehor\Myblog\controllers\AuthController\AuthController;
use Rehor\Myblog\controllers\DBController\DBController;
use Rehor\Myblog\controllers\AdminControllers\AdminController\traits\AdminControllerTrait;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorDoctrineRepository\DBConnectorDoctrineRepository;

class AdminController implements AdminControllerInterface
{
    use AdminControllerTrait;

    public static function authAdmin(): void
    {
        if (AuthController::checkSession() && self::checkAdmin()) {
            header("Location: /admin");
            exit();
        } else {
            self::preventAdmin();
        }
    }

    public static function showAdmin(): void
    {
        self::show("admin/admin.php", [ "firstname" => AuthController::retrieveSession()["user_firstname"] ]);
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
        echo "Access denied! Please contact your Admin for further clarities";
        http_response_code(403);
        exit(1);
    }

    public static function logoutAdmin(): void
    {
        AuthController::logout();
    }
}