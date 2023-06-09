<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\BlogController\traits;

trait BlogControllerTrait
{
    public static function validatePostData(object $data): bool
    {
        if (!count($data)) {
            return false;
        }

        foreach ($data as $dataValue) {
            if ($dataValue === "" || is_null($dataValue)) {
                return false;
            }
        }

        return true;
    }
    
    public static function handleException(\Exception $e): void
    {
        echo "Oops... Something bad has happened. More details here: ".$e->getMessage();
        echo "<pre>";
        print_r($e->getTrace());
        echo "</pre>";
        exit(1);
    }
}