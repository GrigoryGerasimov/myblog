<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AdminControllers\AdminUsersController;

use Rehor\Myblog\controllers\AdminControllers\AdminController\AdminController;
use Rehor\Myblog\controllers\AdminControllers\AdminUsersController\interfaces\AdminUsersControllerInterface;
use Rehor\Myblog\controllers\UserController\UserController;
use Rehor\Myblog\controllers\AuthController\AuthController;
use Rehor\Myblog\controllers\DBController\DBController;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorFlightRepository\DBConnectorFlightRepository;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorDoctrineRepository\DBConnectorDoctrineRepository;
use Rehor\Myblog\entities\User;

class AdminUsersController extends AdminController implements AdminUsersControllerInterface
{
    public static function showAdminUsers(): void
    {
        if (AuthController::checkSession()) {
            self::$renderData["firstname"] = AuthController::retrieveSession()["user_firstname"];
            self::$renderData["adminUsersList"] = self::getList("Rehor\Myblog\\entities\User");
        }

        self::show("admin/admin-users/admin-users.php", self::$renderData);
    }

    public static function createUsers(): void
    {
        if (AuthController::checkSession()) {
            self::$renderData["firstname"] = AuthController::retrieveSession()["user_firstname"];
        }

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

        self::show("admin/admin-users/admin-users-create.php", self::$renderData);
    }

    public static function updateUsers(string $id): void
    {
        $request = DBConnectorFlightRepository::requestConnector();

        $userToUpdate = DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\User", [ "id" => $id ]);

        if (self::validateUserData($request)) {

            $password = $request["password"] !== $userToUpdate->password ?  md5($request["password"]) : $userToUpdate->password;            

            try {
                $userToUpdate->email = UserController::handleUserInput($request["email"]);
                $userToUpdate->password = UserController::handleUserInput($password);
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
            self::$renderData = [
                "firstname" => AuthController::retrieveSession()["user_firstname"],
                "id" => $id,
                "email" => $userToUpdate->email,
                "password" => $userToUpdate->password,
                "username" => $userToUpdate->username,
                "firstname" => $userToUpdate->firstname,
                "lastname" => $userToUpdate->lastname,
                "role" => $userToUpdate->role
            ];

            self::show("admin/admin-users/admin-users-update.php", self::$renderData);
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
            self::$renderData = [
                "firstname" => AuthController::retrieveSession()["user_firstname"],
                "id" => $id,
                "email" => $userToDelete->email,
                "password" => $userToDelete->password,
                "username" => $userToDelete->username,
                "firstname" => $userToDelete->firstname,
                "lastname" => $userToDelete->lastname,
                "role" => $userToDelete->role
            ];

            self::show("admin/admin-users/admin-users-delete.php", self::$renderData);
        } else {
            echo "User not found!";
        }
    }
}