<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AdminControllers\AdminRolesController;

use Rehor\Myblog\controllers\AdminControllers\AdminRolesController\interfaces\AdminRolesControllerInterface;
use Rehor\Myblog\controllers\AdminControllers\AdminController\AdminController;
use Rehor\Myblog\controllers\UserController\UserController;
use Rehor\Myblog\controllers\AuthControllers\AuthController\AuthController;
use Rehor\Myblog\controllers\DBController\DBController;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorFlightRepository\DBConnectorFlightRepository;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorDoctrineRepository\DBConnectorDoctrineRepository;
use Rehor\Myblog\entities\Role;

class AdminRolesController extends AdminController implements AdminRolesControllerInterface
{
    public static function showAdminRoles(): void
    {
        if (AuthController::checkSession()) {
            self::$renderData["firstname"] = AuthController::retrieveSession()["user_firstname"];
            self::$renderData["adminRolesList"] = self::getList("Rehor\Myblog\\entities\Role");
        }

        self::show("admin/admin-roles/admin-roles.php", self::$renderData);
    }

    public static function createRoles(): void
    {
        if (AuthController::checkSession()) {
            self::$renderData["firstname"] = AuthController::retrieveSession()["user_firstname"];
        }

        $request = DBConnectorFlightRepository::requestConnector();
        
        if (count($request)) {
            
            if (self::validateRequestData($request)) {
                
                try {
                    $newRole = new Role();
                    $newRole->role_name = UserController::handleUserInput($request["rolename"]);
                    $newRole->permission = $request["permission"];
                    
                    DBConnectorDoctrineRepository::updateConnector(DBController::getDBName(), $newRole);
                    
                    header("Location: /admin/roles");
                    exit();
                
                } catch(\Exception $e) {
                    echo $e->getMessage();
                    exit(1);
                }
            } else {
                self::$renderData = [
                    "firstname" => AuthController::retrieveSession()["user_firstname"],
                    "error" => "Imcomplete role data provided! Please fill all the fields and try once again"
                ];
            }
        }

        self::show("admin/admin-roles/admin-roles-create.php", self::$renderData);
    }

    public static function updateRoles(string $id): void
    {
        $request = DBConnectorFlightRepository::requestConnector();

        $roleToUpdate = DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\Role", [ "id" => $id ]);
        
        if (count($request)) {
            
            if (self::validateRequestData($request)) {
                
                try {
                    $roleToUpdate->role_name = UserController::handleUserInput($request["rolename"]);
                    $roleToUpdate->permission = (int) $request["permission"];
                    
                    DBConnectorDoctrineRepository::updateConnector(DBController::getDBName(), $roleToUpdate);
                    
                    header("Location: /admin/roles");
                    exit();
                
                } catch(\Exception $e) {
                    echo $e->getMessage();
                    exit(1);
                }
            } else {
                self::$renderData = [
                    "firstname" => AuthController::retrieveSession()["user_firstname"],
                    "error" => "Imcomplete role data provided! Please fill all the fields and try once again"
                ];
            }
        }

        if (AuthController::checkSession()) {
            self::$renderData["firstname"] = AuthController::retrieveSession()["user_firstname"];

            if (!is_null($roleToUpdate)) {
                self::$renderData = [
                    "firstname" => AuthController::retrieveSession()["user_firstname"],
                    "id" => $id,
                    "rolename" => $roleToUpdate->role_name,
                    "permission" => $roleToUpdate->permission
                ];
            } else {
                self::$renderData = [
                    "firstname" => AuthController::retrieveSession()["user_firstname"],
                    "error" => "No role found!"
                ];
            }
        }

        self::show("admin/admin-roles/admin-roles-update.php", self::$renderData);
    }

    public static function deleteRoles(string $id): void
    {
        $request = DBConnectorFlightRepository::requestConnector();

        $roleToDelete = DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\Role", [ "id" => $id ]);

        if (self::validateRequestData($request)) {

            try {
                DBConnectorDoctrineRepository::deleteConnector(DBController::getDBName(), $roleToDelete);

                header("Location: /admin/roles");
                exit();

            } catch(\Exception $e) {
                echo $e->getMessage();
                exit(1);
            }
        }
        
        if (AuthController::checkSession()) {
            self::$renderData["firstname"] = AuthController::retrieveSession()["user_firstname"];

            if (!is_null($roleToDelete)) {
                self::$renderData = [
                    "firstname" => AuthController::retrieveSession()["user_firstname"],
                    "id" => $id,
                    "rolename" => $roleToDelete->role_name,
                    "permission" => $roleToDelete->permission
                ];
            } else {
                self::$renderData = [
                    "firstname" => AuthController::retrieveSession()["user_firstname"],
                    "error" => "No role found!"
                ];
            }
        }

        self::show("admin/admin-roles/admin-roles-delete.php", self::$renderData);
    }
}