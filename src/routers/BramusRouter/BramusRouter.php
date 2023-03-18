<?php

declare(strict_types=1);

namespace Rehor\Myblog\routers\BramusRouter;

use Rehor\Myblog\routers\Router\Router;

class BramusRouter extends Router
{
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
        $this->router->get($path, $fn);
        $this->router->run();
    }
    
    public function usePost(string $path, ?callable $fn): void
    {
        $this->router->post($path, $fn);
        $this->router->run();
    }
}