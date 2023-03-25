<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\DBConnectors\DBConnectorDoctrine\interfaces;

use Rehor\Myblog\models\DBConnectors\interfaces\DBConnectorInterface;

interface DBConnectorDoctrineInterface extends DBConnectorInterface
{
    public static function requestRepository(string $dbName, string $className): object;
    
    public static function insertIntoRepository(string $dbName, object $class): void;
}