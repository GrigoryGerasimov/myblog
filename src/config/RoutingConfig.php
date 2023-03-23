<?php

declare(strict_types=1);

namespace Rehor\Myblog\config;

use Rehor\Myblog\controllers\BlogController\BlogPostController\BlogPostController;

class RoutingConfig extends Config
{
    public static function useFlight()
    {
        \Flight::route("/posts", fn() => BlogPostController::readAll());
        \Flight::route("/posts/create", fn() => BlogPostController::create());
        \Flight::route("/posts/@uid", function($uid) { BlogPostController::readOne($uid); });
        \Flight::route("/posts/@uid/update", function($uid) { BlogPostController::update($uid); });
        \Flight::route("/posts/@uid/delete", function($uid) { BlogPostController::delete($uid); });
    }
}