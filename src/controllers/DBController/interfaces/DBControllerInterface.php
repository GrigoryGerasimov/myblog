<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\DBController\interfaces;

interface DBControllerInterface
{
    public static function select(?array $params): object;

    public static function insert(object $data): void;
    
    public static function update(?array $params, object $data): object;
    
    public static function delete(?array $params): void;
}