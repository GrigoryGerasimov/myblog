<?php

declare(strict_types=1);

use Rehor\Myblog\controllers\BlogController\BlogPostController\BlogPostController;

Flight::route("/posts/create", fn() => BlogPostController::create());

Flight::route("/posts/@uid", function($uid) { BlogPostController::readOne($uid); });