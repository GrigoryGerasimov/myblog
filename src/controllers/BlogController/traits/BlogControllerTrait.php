<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\BlogController\traits;

trait BlogControllerTrait
{
    public static function validatePostData(object $data): bool
    {
        return (bool)count($data);
    }
    
    public static function handleException(\Exception $e): void
    {
        echo "Oops... Something bad has happened. More details here: ".$e->getMessage();
        exit(1);
    }
}