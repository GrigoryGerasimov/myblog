<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Post\interfaces;

interface PostInterface
{
    public function add(): void;
    
    public function update(array $params): object;
    
    public function getOne(array $params): object;
    
    public function getAll(): object;
    
    public function delete(array $params): void;
}