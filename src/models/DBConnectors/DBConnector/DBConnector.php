<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\DBConnectors\DBConnector;

use Rehor\Myblog\models\DBConnectors\DBConnector\interfaces\DBConnectorInterface;

abstract class DBConnector implements DBConnectorInterface
{
    abstract public static function init(string $dbName): object;
}