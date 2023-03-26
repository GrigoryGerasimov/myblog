<?php

declare(strict_types=1);

namespace Rehor\Myblog\config;

use Rehor\Myblog\controllers\BlogController\BlogPostController\BlogPostController;
use Rehor\Myblog\controllers\UserController\UserController;
use Rehor\Myblog\controllers\AuthController\AuthController;
use Rehor\Myblog\controllers\ProfileController\ProfileController;

class RoutingConfig extends Config
{
    public static function useFlight()
    {
        \Flight::route("/posts", fn() => BlogPostController::readAll());
        \Flight::route("/posts/create", fn() => BlogPostController::create());
        \Flight::route("/posts/@uid", function($uid) { BlogPostController::readOne($uid); });
        \Flight::route("/posts/@uid/update", function($uid) { BlogPostController::update($uid); });
        \Flight::route("/posts/@uid/delete", function($uid) { BlogPostController::delete($uid); });
        
        \Flight::route("/login", fn() => UserController::login());
        \Flight::route("/register", fn() => UserController::register());
        
        \Flight::route("/auth/login", fn() => AuthController::auth());
        \Flight::route("/auth/logout", fn() => AuthController::logout());
        
        \Flight::route("/profile", fn() => ProfileController::showProfile());
        \Flight::route("/profile/update", fn() => ProfileController::updateProfile());
        \Flight::route("/profile/delete", fn() => ProfileController::removeProfile());
    }
}