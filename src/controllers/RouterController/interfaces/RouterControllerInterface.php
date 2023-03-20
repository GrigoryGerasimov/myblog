<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\RouterController\interfaces;

use Rehor\Myblog\routers\Router\Router;


interface RouterControllerInterface
{
    public function register(Router $router): self;

    public function useGet(string $path, ?callable $fn): self;
    
    public function usePost(string $path, ?callable $fn): self;
}