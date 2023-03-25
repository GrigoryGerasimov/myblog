<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\DBConnectors\interfaces;

interface DBConnectorInterface
{
    public static function init(string $dbName): object;
}