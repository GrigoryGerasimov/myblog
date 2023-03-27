<?php

declare(strict_types=1);

namespace Rehor\Myblog\routes\userRoutes;

use Rehor\Myblog\controllers\UserController\UserController;

function getUserRoutes(): array
{
    return [
        "/login" => fn() => UserController::login(),
        "/register" => fn() => UserController::register()
    ];
}