<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\DBConnectors\DBConnectorFlight\interfaces;

use Rehor\Myblog\models\DBConnectors\DBConnector\interfaces\DBConnectorInterface;

interface DBConnectorFlightInterface extends DBConnectorInterface
{
    public static function requestData(): object;
}