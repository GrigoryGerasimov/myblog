<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\DBConnectors\DBConnectorFlight;

use Rehor\Myblog\models\DBConnectors\DBConnectorFlight\interfaces\DBConnectorFlightInterface;
use Rehor\Myblog\models\DBConnectors\DBConnector\DBConnector;

final class DBConnectorFlight extends DBConnector implements DBConnectorFlightInterface
{
    public static function init(string $dbName): object
    {
        \Flight::register("db", "mysqli", array("localhost:5600", "root", "root", $dbName));
        
        return \Flight::db();
    }
    
    public static function requestData(): object
    {
        return \Flight::request()->data;
    }
}