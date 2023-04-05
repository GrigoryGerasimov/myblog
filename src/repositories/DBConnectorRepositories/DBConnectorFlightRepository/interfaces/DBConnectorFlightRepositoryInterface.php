<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorFlightRepository\interfaces;

use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorRepository\interfaces\DBConnectorRepositoryInterface;

interface DBConnectorFlightRepositoryInterface extends DBConnectorRepositoryInterface
{
    public static function initConnector(string $dbName): object;
    
    public static function requestConnector(): object;
}