<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AdminControllers\AdminController\traits;

require("utils/arrays/flattenArray.php");

use Rehor\Myblog\controllers\DBController\DBController;
use Rehor\Myblog\repositories\RendererRepository\RendererRepository;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorDoctrineRepository\DBConnectorDoctrineRepository;
use Rehor\Myblog\repositories\AuthRepository\AuthRepository;

use function Rehor\Myblog\utils\arrays\flattenArray;

trait AdminControllerTrait
{
    public static function show(string $adminPagePath, array $params)
    {
        if (AuthRepository::verifyAuthStatus() && self::checkAdmin()) {

            RendererRepository::displayView($adminPagePath, $params);
        } else {
            header("Location: /access-denied");
            exit(1);
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
                    "password" => substr($class->password, 0, 20),
                    "firstname" => $class->firstname,
                    "lastname" => $class->lastname,
                    "username" => $class->username,
                    "role" => DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\Role", [ "id" => $class->roles_mask ])->role_name 
                ];
            }

            case "Role": {
                return [
                    "id" => $class->id,
                    "rolename" => $class->role_name,
                    "permission" => (int) $class->permission
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

    public static function validateRequestData(object $requestData): bool
    {
        if (!count($requestData)) {
            return false;
        }

        foreach ($requestData as $requestDataValue) {
            if ($requestDataValue === "" || is_null($requestDataValue)) {
                return false;
            }
        }

        return true;
    }
}