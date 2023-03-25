<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\DBConnectorRepository;

use Rehor\Myblog\repositories\DBConnectorRepository\interfaces\DBConnectorRepositoryInterface;
use Rehor\Myblog\models\DBConnectors\DBConnectorFlight\DBConnectorFlight;
use Rehor\Myblog\models\DBConnectors\DBConnectorDoctrine\DBConnectorDoctrine;

class DBConnectorRepository implements DBConnectorRepositoryInterface
{
    public static function initConnectorFlight(string $dbName): object
    {
        return DBConnectorFlight::init($dbName);
    }
    
    public static function requestConnectorFlight(): object
    {
        return DBConnectorFlight::requestData();
    }
    
    public static function initConnectorDoctrine(string $dbName): object
    {
        return DBConnectorDoctrine::init($dbName);
    }
    
    public static function requestConnectorDoctrine(string $dbName, string $className): object
    {
        return DBConnectorDoctrine::requestRepository($dbName, $className);
    }
    
    public static function updateConnectorDoctrine(string $dbName, object $class): void
    {
        DBConnectorDoctrine::insertIntoRepository($dbName, $class);
    }
}