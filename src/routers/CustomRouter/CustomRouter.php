<?php

declare(strict_types=1);

namespace Rehor\Myblog\routers\CustomRouter;

use Rehor\Myblog\routers\Router\Router;
use Rehor\Myblog\routers\CustomRouter\traits\CustomRouterTrait;

class CustomRouter extends Router
{
    use CustomRouterTrait;

    public function __construct()
    {
        $this->router = null;
    }
    
    public function __destruct()
    {
        $this->router = null;
    }
    
    public function useGet(string $path, ?callable $fn): void
    {
        switch ($path) {
            case "/":
                $this->hasCallable(function() {
                    echo "Got Main from CustomRouter";
                }, $fn);
                break;
            case "/about":
                $this->hasCallable(function() {
                    echo "Got About from CustomRouter";
                }, $fn);
                break;
            default:
                echo "Oops... Page not found";
                break;
        }
    }
    
    public function usePost(string $path, ?callable $fn): void
    {
        switch ($path) {
            case "/":
                $this->hasCallable(function() {
                    echo "Posted into Main from CustomRouter";
                }, $fn);
                break;
            case "/about":
                $this->hasCallable(function() {
                    echo "Posted into About from CustomRouter";
                }, $fn);
                break;
            default:
                echo "Oops... Page not found";
                break;
        }
    }
}