<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AdminController;

use Rehor\Myblog\controllers\AdminController\interfaces\AdminControllerInterface;
use Rehor\Myblog\controllers\AuthController\AuthController;
use Rehor\Myblog\controllers\DBController\DBController;
use Rehor\Myblog\controllers\AdminController\traits\AdminControllerTrait;
use Rehor\Myblog\controllers\UserController\UserController;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorDoctrineRepository\DBConnectorDoctrineRepository;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorFlightRepository\DBConnectorFlightRepository;
use Rehor\Myblog\entities\User;

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
    
    public static function showAdminPosts(): void
    {        
        self::show("admin/admin-posts.php", [
            "firstname" => AuthController::retrieveSession()["user_firstname"],
            "adminPostsList" => self::getList("Rehor\Myblog\\entities\Post")
        ]);
    }

    public static function showAdminUsers(): void
    {
        self::show("admin/admin-users/admin-users.php", [
            "firstname" => AuthController::retrieveSession()["user_firstname"],
            "adminUsersList" => self::getList("Rehor\Myblog\\entities\User")
        ]);
    }

    public static function showAdminRoles(): void
    {
        self::show("admin/admin-roles.php", [
            "firstname" => AuthController::retrieveSession()["user_firstname"],
            "adminRolesList" => self::getList("Rehor\Myblog\\entities\Role")
        ]);
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

    public static function createUsers(): void
    {
        $request = DBConnectorFlightRepository::requestConnector();
        
        if (self::validateUserData($request)) {

            $hashedPassword = md5($request["password"]);

            try {
                $newUser = new User();
                $newUser->email = UserController::handleUserInput($request["email"]);
                $newUser->password = $hashedPassword;
                $newUser->username = UserController::handleUserInput($request["username"]);
                $newUser->firstname = UserController::handleUserInput($request["firstname"]);
                $newUser->lastname = UserController::handleUserInput($request["lastname"]);
                $newUser->role = (int) $request["role"];

                DBConnectorDoctrineRepository::updateConnector(DBController::getDBName(), $newUser);

                header("Location: /admin/users");
                exit();

            } catch(\Exception $e) {
                echo $e->getMessage();
                exit(1);
            }
        }

        self::show("admin/admin-users/admin-users-create.php", [
            "firstname" => AuthController::retrieveSession()["user_firstname"],
        ]);
    }

    public static function updateUsers(string $id): void
    {
        $request = DBConnectorFlightRepository::requestConnector();

        $userToUpdate = DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\User", [ "id" => $id ]);

        if (self::validateUserData($request)) {

            $hashedPassword = md5($request["password"]);

            try {
                $userToUpdate->email = UserController::handleUserInput($request["email"]);
                $userToUpdate->password = $hashedPassword;
                $userToUpdate->username = UserController::handleUserInput($request["username"]);
                $userToUpdate->firstname = UserController::handleUserInput($request["firstname"]);
                $userToUpdate->lastname = UserController::handleUserInput($request["lastname"]);
                $userToUpdate->role = (int) $request["role"];

                DBConnectorDoctrineRepository::updateConnector(DBController::getDBName(), $userToUpdate);

                header("Location: /admin/users");
                exit();

            } catch(\Exception $e) {
                echo $e->getMessage();
                exit(1);
            }
        }

        if (!is_null($userToUpdate)) {
            self::show("admin/admin-users/admin-users-update.php", [
                "firstname" => AuthController::retrieveSession()["user_firstname"],
                "id" => $id,
                "email" => $userToUpdate->email,
                "password" => $userToUpdate->password,
                "username" => $userToUpdate->username,
                "firstname" => $userToUpdate->firstname,
                "lastname" => $userToUpdate->lastname,
                "role" => $userToUpdate->role
            ]);
        } else {
            echo "User not found!";
        }
    }

    public static function deleteUsers(string $id): void
    {
        $request = DBConnectorFlightRepository::requestConnector();

        $userToDelete = DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\User", [ "id" => $id ]);

        if (self::validateUserData($request)) {

            try {
                DBConnectorDoctrineRepository::deleteConnector(DBController::getDBName(), $userToDelete);

                header("Location: /admin/users");
                exit();

            } catch(\Exception $e) {
                echo $e->getMessage();
                exit(1);
            }
        }

        if (!is_null($userToDelete)) {
            self::show("admin/admin-users/admin-users-delete.php", [
                "firstname" => AuthController::retrieveSession()["user_firstname"],
                "id" => $id,
                "email" => $userToDelete->email,
                "password" => $userToDelete->password,
                "username" => $userToDelete->username,
                "firstname" => $userToDelete->firstname,
                "lastname" => $userToDelete->lastname,
                "role" => $userToDelete->role
            ]);
        } else {
            echo "User not found!";
        }
    }
}