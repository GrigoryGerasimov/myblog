<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\DBConnectorRepository\interfaces;

interface DBConnectorRepositoryInterface
{
    public static function initConnectorFlight(string $dbName): object;    
    
    public static function requestConnectorFlight(): object;
        
    public static function initConnectorDoctrine(string $dbName): object;
    
    public static function requestConnectorDoctrine(string $dbName, string $className): object;
    
    public static function updateConnectorDoctrine(string $dbName, object $class): void;
}