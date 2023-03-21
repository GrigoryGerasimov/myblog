<?php

declare(strict_types=1);

namespace Rehor\Myblog\config\interfaces\FlightRouterConfigInterface;

use Rehor\Myblog\config\interfaces\ConfigInterface;

interface FlightRouterConfigInterface extends ConfigInterface
{
    public static function setConfig(string $methodName, string $className, ?array $additionalParams = []): void;
}