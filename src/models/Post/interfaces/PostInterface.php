<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Post\interfaces;

interface PostInterface
{
    public function add(): void;
    
    public function update(string $uid): object;
    
    public function getOne(string $uid): object;
    
    public function getAll(): object;
    
    public function delete(string $uid): bool;
}