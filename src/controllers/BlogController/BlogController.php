<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\BlogController;

abstract class BlogController
{
    abstract public static function create();
    
    abstract public static function readOne(string $uid);
    
    abstract public static function readAll();
    
    abstract public static function update(string $uid);
    
    abstract public static function delete(string $uid);
}