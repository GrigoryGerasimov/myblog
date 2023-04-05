<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\PostRepository;

use Rehor\Myblog\repositories\PostRepository\interfaces\PostRepositoryInterface;
use Rehor\Myblog\models\Post\Post;

final class PostRepository implements PostRepositoryInterface
{
    public static function PostInstance(?object $postData = null)
    {
        return new Post($postData);
    }

    public static function createNewPost(object $postData): void
    {
        self::PostInstance($postData)->add();
    }
    
    public static function getOnePost(array $postParams): ?array
    {
        return mysqli_fetch_assoc(self::PostInstance()->getOne($postParams));
    }
    
    public static function getAllPosts(): ?array
    {
        return self::PostInstance()->getAll()->fetch_all(MYSQLI_ASSOC);
    }
    
    public static function updatePost(array $postParams, object $postData): array
    {
        return mysqli_fetch_assoc(self::PostInstance($postData)->update($postParams));
    }
    
    public static function deletePost(array $postParams): void
    {
        self::PostInstance()->delete($postParams);
    }
}