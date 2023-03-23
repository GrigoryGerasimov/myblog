<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\PostRepository;

use Rehor\Myblog\repositories\PostRepository\interfaces\PostRepositoryInterface;
use Rehor\Myblog\models\Post\Post;

class PostRepository implements PostRepositoryInterface
{
    public static function PostInstance(?object $postData = null)
    {
        return new Post($postData);
    }

    public static function createNewPost(object $postData): void
    {
        self::PostInstance($postData)->add();
    }
    
    public static function getOnePost(string $postId): ?array
    {
        return mysqli_fetch_assoc(self::PostInstance()->getOne($postId));
    }
    
    public static function getAllPosts(): ?array
    {
        return self::PostInstance()->getAll()->fetch_all(MYSQLI_ASSOC);
    }
    
    public static function updatePost(string $postId, object $postData): array
    {
        return mysqli_fetch_assoc(self::PostInstance($postData)->update($postId));
    }
    
    public static function deletePost(string $postId): void
    {
        self::PostInstance()->delete($postId);
    }
}