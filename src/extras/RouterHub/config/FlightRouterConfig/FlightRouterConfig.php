<?php

declare(strict_types=1);

namespace Rehor\Myblog\config\FlightRouterConfig;

use Rehor\Myblog\config\interfaces\FlightRouterConfigInterface;

class FlightRouterConfig implements FlightRouterConfigInterface
{
    public static function setConfig(string $methodName, string $className, ?array $additionalParams = []): void
    {
        \Flight::register($methodName, $className, $additionalParams);
        \Flight::path(dirname(__FILE__)."\conrollers");
        \Flight::path(dirname(__FILE__)."\models");        
    }
    
    public static function init(): void
    {
        \Flight::start();
    }
}