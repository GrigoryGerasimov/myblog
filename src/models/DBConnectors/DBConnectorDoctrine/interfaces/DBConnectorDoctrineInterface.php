<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\DBConnectors\DBConnectorDoctrine\interfaces;

use Rehor\Myblog\models\DBConnectors\DBConnector\interfaces\DBConnectorInterface;

interface DBConnectorDoctrineInterface extends DBConnectorInterface
{
    public static function requestRepository(string $dbName, string $className): object;
    
    public static function retrieveOneFromRepository(string $dbName, string $className, array $params): ?object;

    public static function retrieveAllFromRepository(string $dbName, string $className): ?array;
    
    public static function insertIntoRepository(string $dbName, object $class): void;
    
    public static function updateInRepository(string $dbName, object $class): void;
    
    public static function removeRepository(string $dbName, object $class): void;
}