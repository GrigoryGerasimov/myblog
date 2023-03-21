<?php

declare(strict_types=1);

namespace Rehor\Myblog\routers\BramusRouter;

use Rehor\Myblog\routers\Router\Router;
use Rehor\Myblog\routers\Router\traits\RouterTrait;

class BramusRouter extends Router
{
    use RouterTrait;

    public function __construct()
    {
        $this->router = new \Bramus\Router\Router();
    }
    
    public function __destruct()
    {
        $this->router = null;
    }
    
    public function useGet(string $path, ?callable $fn): void
    {
        $this->router->get($path, $this->hasCallable(fn() => function() use($path) {
            echo "Got $path alternatively from BramusRouter";
        }, $fn));
        $this->router->run();
    }
    
    public function usePost(string $path, ?callable $fn): void
    {
        $this->router->post($path, $this->hasCallable(fn() => function() use($path) {
            echo "Posted $path alternatively from BramusRouter";
        }, $fn));
        $this->router->run();
    }
}