<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorRepository;

use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorRepository\interfaces\DBConnectorRepositoryInterface;

abstract class DBConnectorRepository implements DBConnectorRepositoryInterface
{
    abstract public static function initConnector(string $dbName): object;
}