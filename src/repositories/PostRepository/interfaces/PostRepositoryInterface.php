<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\PostRepository\interfaces;

interface PostRepositoryInterface
{
    public static function createNewPost(object $postData): void;
    
    public static function getOnePost(string $postId): ?array;
    
    public static function getAllPosts(): ?array;
    
    public static function updatePost(string $postId, object $postData): array;
    
    public static function deletePost(string $postId): void;
}