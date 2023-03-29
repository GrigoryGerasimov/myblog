<?php

declare(strict_types=1);

namespace Rehor\Myblog\routes\utilsRoutes;

use Rehor\Myblog\controllers\AdminControllers\AdminController\AdminController;

function getUtilsRoutes()
{
    return [
        "/access-denied" => fn() => AdminController::preventAdmin()
    ];
}