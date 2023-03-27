<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AdminController;

use Rehor\Myblog\controllers\AdminController\interfaces\AdminControllerInterface;
use Rehor\Myblog\controllers\AuthController\AuthController;
use Rehor\Myblog\controllers\DBController\DBController;
use Rehor\Myblog\controllers\AdminController\traits\AdminControllerTrait;
use Rehor\Myblog\repositories\RendererRepository\RendererRepository;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorDoctrineRepository\DBConnectorDoctrineRepository;

class AdminController implements AdminControllerInterface
{
    use AdminControllerTrait;

    public static function authAdmin()
    {
        if (AuthController::checkSession() && self::checkAdmin()) {
            header("Location: /admin");
            exit();
        } else {
            self::preventAdmin();
        }
    }

    public static function showAdmin()
    {
        self::show("admin/admin.php", [ "firstname" => AuthController::retrieveSession()["user_firstname"] ]);
    }
    
    public static function showAdminPosts()
    {
        self::show("admin/admin-posts.php", [ "firstname" => AuthController::retrieveSession()["user_firstname"] ]);
    }

    public static function showAdminUsers()
    {
        self::show("admin/admin-users.php", [ "firstname" => AuthController::retrieveSession()["user_firstname"] ]);
    }

    public static function showAdminRoles()
    {
        self::show("admin/admin-roles.php", [ "firstname" => AuthController::retrieveSession()["user_firstname"] ]);
    }

    public static function checkAdmin()
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

    public static function preventAdmin()
    {
        echo "Access denied! Please contact your Admin for further clarities";
        http_response_code(403);
        exit(1);
    }

    public static function logoutAdmin()
    {
        AuthController::logout();
    }
}