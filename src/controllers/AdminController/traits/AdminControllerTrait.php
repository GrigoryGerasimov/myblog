<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AdminController\traits;

use Rehor\Myblog\controllers\AuthController\AuthController;
use Rehor\Myblog\repositories\RendererRepository\RendererRepository;

trait AdminControllerTrait
{
    public static function show(string $adminPagePath, array $params)
    {
        if (AuthController::checkSession() && self::checkAdmin()) {

            RendererRepository::displayView($adminPagePath, $params);
        } else {
            self::preventAdmin();
        }
    }
}