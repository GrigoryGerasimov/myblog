<?php

declare(strict_types=1);

namespace Rehor\Myblog\routers\Router\interfaces;

interface RouterInterface
{
    public function useGet(string $path, ?callable $fn): void;
    
    public function usePost(string $path, ?callable $fn): void;
}