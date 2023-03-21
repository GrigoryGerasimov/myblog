<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\DBController\interfaces;

interface DBControllerInterface
{
    public static function select(?string $id): object;

    public static function insert(object $data): void;
    
    public static function update(string $id, object $data): object;
    
    public static function delete(string $id): void;
}