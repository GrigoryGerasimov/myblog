<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AdminControllers\AdminController\traits;

require("utils/arrays/flattenArray.php");

use Rehor\Myblog\controllers\AuthController\AuthController;
use Rehor\Myblog\controllers\DBController\DBController;
use Rehor\Myblog\repositories\RendererRepository\RendererRepository;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorDoctrineRepository\DBConnectorDoctrineRepository;

use function Rehor\Myblog\utils\arrays\flattenArray;

trait AdminControllerTrait
{
    public static function show(string $adminPagePath, array $params)
    {
        if (AuthController::checkSession() && self::checkAdmin()) {

            RendererRepository::displayView($adminPagePath, $params);
        } else {
            self::preventAdmin();
        }
    }

    private static function getParamsSet(object $class, string $className): array
    {
        switch ($className) {
            case "Post": {
                return [
                    "uid" => $class->uid,
                    "title" => $class->title,
                    "author" => $class->author,
                    "description" => substr($class->text, 0, 200)
                ];
            }

            case "User": {
                return [
                    "id" => $class->id,
                    "email" => $class->email,
                    "password" => $class->password,
                    "firstname" => $class->firstname,
                    "lastname" => $class->lastname,
                    "username" => $class->username,
                    "role" => DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\Role", [ "id" => $class->role ])->role_name 
                ];
            }

            case "Role": {
                return [
                    "id" => $class->id,
                    "rolename" => $class->role_name,
                    "permission" => $class->permission
                ];
            }

            default: return [];
        }
    }

    public static function getList(string $classFullName): array
    {
        $itemsList = DBConnectorDoctrineRepository::retrieveAllFromConnector(DBController::getDBName(), $classFullName);

        $items = [];
        foreach(flattenArray($itemsList) as $item) {

            $classNameSplitted = explode("\\", $classFullName);
            $className = $classNameSplitted[count($classNameSplitted) - 1];

            $items[spl_object_id($item)] = self::getParamsSet($item, $className);
        }

        return $items;
    }

    public static function validateUserData(object $userRequest): bool
    {
        if (!count($userRequest)) {
            return false;
        }

        foreach ($userRequest as $userRequestValue) {
            if ($userRequestValue === "" || is_null($userRequestValue)) {
                return false;
            }
        }

        return true;
    }
}