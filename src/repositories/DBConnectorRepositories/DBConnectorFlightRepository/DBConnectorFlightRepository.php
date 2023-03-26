<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorFlightRepository;

use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorFlightRepository\interfaces\DBConnectorFlightRepositoryInterface;
use Rehor\Myblog\models\DBConnectors\DBConnectorFlight\DBConnectorFlight;

class DBConnectorFlightRepository implements DBConnectorFlightRepositoryInterface
{
    public static function initConnector(string $dbName): object
    {
        return DBConnectorFlight::init($dbName);
    }
    
    public static function requestConnector(): object
    {
        return DBConnectorFlight::requestData();
    }
}