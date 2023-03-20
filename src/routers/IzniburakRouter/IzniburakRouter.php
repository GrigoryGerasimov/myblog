<?php

declare(strict_types=1);

namespace Rehor\Myblog\routers\IzniburakRouter;

use Rehor\Myblog\routers\Router\Router;
use Rehor\Myblog\routers\Router\traits\RouterTrait;
use Buki\Router\Router as IzniRouter;

class IzniburakRouter extends Router
{
    use RouterTrait;

    public function __construct()
    {
        $this->router = new IzniRouter();
    }
    
    public function __destruct()
    {
        $this->router = null;
    }
    
    public function useGet(string $path, ?callable $fn): void
    {
        $this->router->get($path, $this->hasCallable(fn() => function() use($path) {
            echo "Got $path from IzniburakRouter";
        }), $fn);
        $this->router->run();
    }
    
    public function usePost(string $path, ?callable $fn): void
    {
        $this->router->post($path, $this->hasCallable(fn() => function() use($path) {
            echo "Posted $path from IzniburakRouter";
        }), $fn);
    }
}