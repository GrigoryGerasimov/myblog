<?php

declare(strict_types=1);

namespace Rehor\Myblog\routers\Router\traits;

trait RouterTrait
{
    public function hasCallable(callable $altFn, ?callable $userFn = null)
    {
        return !is_null($userFn) ? $userFn : $altFn;
    }
}