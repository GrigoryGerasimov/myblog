<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\RouterController;

use Rehor\Myblog\controllers\RouterController\interfaces\RouterControllerInterface;
use Rehor\Myblog\routers\Router\Router;

final class RouterController implements RouterControllerInterface
{
    protected $router = null;
    
    public function register(Router $router): self
    {
        $this->router = $router;
        return $this;
    }
    
    public function useGet(string $path, ?callable $fn = null): self
    {
        $this->router->useGet($path, $fn);
        return $this;
    }
        
    public function usePost(string $path, ?callable $fn = null): self
    {
        $this->router->usePost($path, $fn);
        return $this;
    }
}