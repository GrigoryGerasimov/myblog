<?php

declare(strict_types=1);

namespace Rehor\Myblog\routers\FlightRouter;

use Rehor\Myblog\routers\Router\Router;
use Rehor\Myblog\routers\Router\traits\RouterTrait;
use flight\Engine;

class FlightRouter extends Router
{
    use RouterTrait;

    public function __construct()
    {
        $this->router = new Engine();
    }
    
    public function __destruct()
    {
        $this->router = null;
    }
    
    public function useGet(string $path, ?callable $fn): void
    {
        $this->router->route("GET $path", $this->hasCallable(fn() => function() use($path) {
            echo "Got $path from FlightRouter";
        }, $fn));
        $this->router->start();
    }
    
    public function usePost(string $path, ?callable $fn): void
    {
        $this->router->route("POST $path", $this->hasCallable(fn() => function() use($path) {
            echo "Posted $path from FlightRouter";
        }, $fn));
        $this->router->start();
    }
}