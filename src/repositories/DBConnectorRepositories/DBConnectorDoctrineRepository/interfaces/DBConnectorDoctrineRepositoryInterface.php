<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorDoctrineRepository\interfaces;

interface DBConnectorDoctrineRepositoryInterface
{
    public static function initConnector(string $dbName): object;
    
    public static function requestConnector(string $dbName, string $className): object;
    
    public static function retrieveOneFromConnector(string $dbName, string $className, array $params): ?object;

    public static function retrieveAllFromConnector(string $dbName, string $className): ?array;
    
    public static function updateConnector(string $dbName, object $class): void;
    
    public static function editConnector(string $dbName, object $class): void;
    
    public static function deleteConnector(string $dbName, object $class): void;
}