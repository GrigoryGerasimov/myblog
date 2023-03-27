<?php

declare(strict_types=1);

namespace Rehor\Myblog\config;

class RoutingConfig extends Config
{
    public static function useFlight(array $routes)
    {
        foreach ($routes as $routePath => $routeAction) {
            \Flight::route($routePath, $routeAction);
        }
    }
}