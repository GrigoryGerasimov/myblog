<?php

declare(strict_types=1);

namespace Rehor\Myblog\routers\CustomRouter\traits;

trait CustomRouterTrait
{
    public function hasCallable(callable $altFn, ?callable $userFn = null)
    {
        return !is_null($userFn) ? call_user_func($userFn) : call_user_func($altFn);
    }
}