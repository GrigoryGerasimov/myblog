<?php

declare(strict_types=1);

namespace Rehor\Myblog\routes\authRoutes;

use Rehor\Myblog\controllers\AuthController\AuthController;

function getAuthRoutes(): array
{
    return [
        "/auth/login" => fn() => AuthController::auth(),
        "/auth/logout" => fn() => AuthController::logout()
    ];
}