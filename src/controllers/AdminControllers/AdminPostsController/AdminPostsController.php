<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AdminControllers\AdminPostsController;

use Rehor\Myblog\controllers\AdminControllers\AdminPostsController\interfaces\AdminPostsControllerInterface;
use Rehor\Myblog\controllers\AdminControllers\AdminController\AdminController;
use Rehor\Myblog\controllers\AuthController\AuthController;

class AdminPostsController extends AdminController implements AdminPostsControllerInterface
{
    public static function showAdminPosts(): void
    {        
        self::show("admin/admin-posts/admin-posts.php", [
            "firstname" => AuthController::retrieveSession()["user_firstname"],
            "adminPostsList" => self::getList("Rehor\Myblog\\entities\Post")
        ]);
    }

    public static function showOnePost(string $uid): void
    {
        self::show("admin/admin-posts/admin-post.php", [
            "firstname" => AuthController::retrieveSession()["user_firstname"],
            "uid" => $uid
        ]);
    }

    public static function createPosts(): void
    {

    }

    public static function updatePosts(string $id): void
    {

    }

    public static function deletePosts(string $id): void
    {

    }
}