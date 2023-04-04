<?php

declare(strict_types=1);

namespace Rehor\Myblog\routes\authRoutes;

use Rehor\Myblog\controllers\AuthControllers\AuthController\AuthController;

function getAuthRoutes(): array
{
    return [
        "/auth/login" => fn() => AuthController::auth(),
        "/auth/logout" => fn() => AuthController::logout()
    ];
}