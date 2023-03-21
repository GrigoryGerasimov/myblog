<?php

namespace Rehor\Myblog\routers\Router;

use Rehor\Myblog\routers\Router\interfaces\RouterInterface;

abstract class Router implements RouterInterface
{
    protected $router = null;

    abstract public function useGet(string $path, ?callable $fn): void;
    
    abstract public function usePost(string $path, ?callable $fn): void;
}

