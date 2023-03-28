<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorDoctrineRepository;

use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorDoctrineRepository\interfaces\DBConnectorDoctrineRepositoryInterface;
use Rehor\Myblog\models\DBConnectors\DBConnectorDoctrine\DBConnectorDoctrine;

class DBConnectorDoctrineRepository implements DBConnectorDoctrineRepositoryInterface
{
    public static function initConnector(string $dbName): object
    {
        return DBConnectorDoctrine::init($dbName);
    }
    
    public static function requestConnector(string $dbName, string $className): object
    {
        return DBConnectorDoctrine::requestRepository($dbName, $className);
    }
    
    public static function retrieveOneFromConnector(string $dbName, string $className, array $params): ?object
    {
        return DBConnectorDoctrine::retrieveOneFromRepository($dbName, $className, $params);
    }

    public static function retrieveAllFromConnector(string $dbName, string $className): ?array
    {
        return DBConnectorDoctrine::retrieveAllFromRepository($dbName, $className);
    }
    
    public static function updateConnector(string $dbName, object $class): void
    {
        DBConnectorDoctrine::insertIntoRepository($dbName, $class);
    }
    
    public static function editConnector(string $dbName, object $class): void
    {
        DBConnectorDoctrine::updateInRepository($dbName, $class);
    }
    
    public static function deleteConnector(string $dbName, object $class): void
    {
        DBConnectorDoctrine::removeRepository($dbName, $class);
    }
}