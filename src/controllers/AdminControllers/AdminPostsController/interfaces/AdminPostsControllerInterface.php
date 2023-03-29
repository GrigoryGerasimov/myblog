<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\AdminControllers\AdminPostsController\interfaces;

use Rehor\Myblog\controllers\AdminControllers\AdminController\interfaces\AdminControllerInterface;

interface AdminPostsControllerInterface extends AdminControllerInterface
{
    public static function showAdminPosts(): void;

    public static function showOnePost(string $uid): void;

    public static function createPosts(): void;

    public static function updatePosts(string $uid): void;

    public static function deletePosts(string $uid): void;
}