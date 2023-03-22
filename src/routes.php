<?php

declare(strict_types=1);

use Rehor\Myblog\controllers\BlogController\BlogPostController\BlogPostController;

Flight::route("/posts", fn() => BlogPostController::readAll());

Flight::route("/posts/create", fn() => BlogPostController::create());

Flight::route("/posts/@uid", function($uid) { BlogPostController::readOne($uid); });

Flight::route("/posts/@uid/update", function($uid) { BlogPostController::update($uid); });

Flight::route("/posts/@uid/delete", function($uid) { BlogPostController::delete($uid); });