<?php

declare(strict_types=1);

namespace Rehor\Myblog\routes\profileRoutes;

use Rehor\Myblog\controllers\ProfileController\ProfileController;

function getProfileRoutes(): array
{
    return [
        "/profile" => fn() => ProfileController::showProfile(),
        "/profile/update" => fn() => ProfileController::updateProfile(),
        "/profile/delete" => fn() => ProfileController::removeProfile()
    ];
}