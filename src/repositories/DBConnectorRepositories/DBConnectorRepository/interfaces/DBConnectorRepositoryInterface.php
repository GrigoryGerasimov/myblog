<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorRepository\interfaces;

interface DBConnectorRepositoryInterface
{
    public static function initConnector(string $dbName): object;
}