<?php

declare(strict_types=1);

namespace Rehor\Myblog\routes\authRoutes;

use Rehor\Myblog\controllers\AuthController\AuthController;

function getAuthRoutes(): array
{
    return [
        "/auth/login" => fn() => AuthController::auth(),
        "/auth/logout" => fn() => AuthController::logout(),
        
        "/auth/check/verify_email" => fn() => AuthController::authCheck(),
        
        "/auth/password" => fn() => AuthController::triggerPasswordReset(),
        "/auth/password/reset_password" => fn() => AuthController::resetPassword()
    ];
}