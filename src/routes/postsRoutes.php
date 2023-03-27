<?php

declare(strict_types=1);

namespace Rehor\Myblog\routes\postsRoutes;

use Rehor\Myblog\controllers\BlogController\BlogPostController\BlogPostController;

function getPostsRoutes(): array
{
    return [
        "/posts" => fn() => BlogPostController::readAll(),
        "/posts/create" => fn() => BlogPostController::create(),
        "/posts/@uid" => function($uid) { BlogPostController::readOne($uid); },
        "/posts/@uid/update" => function($uid) { BlogPostController::update($uid); },
        "/posts/@uid/delete" => function($uid) { BlogPostController::delete($uid); }
    ];
}