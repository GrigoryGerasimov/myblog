<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorFlightRepository;

use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorFlightRepository\interfaces\DBConnectorFlightRepositoryInterface;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorRepository\DBConnectorRepository;
use Rehor\Myblog\models\DBConnectors\DBConnectorFlight\DBConnectorFlight;

final class DBConnectorFlightRepository extends DBConnectorRepository implements DBConnectorFlightRepositoryInterface
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