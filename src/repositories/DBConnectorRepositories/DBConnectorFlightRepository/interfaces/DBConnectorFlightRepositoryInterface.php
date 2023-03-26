<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorFlightRepository\interfaces;

interface DBConnectorFlightRepositoryInterface
{
    public static function initConnector(string $dbName): object;
    
    public static function requestConnector(): object;
}