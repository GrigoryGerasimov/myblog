<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\UserController\traits;

trait UserControllerTrait
{
    public static function handleUserInput(string $input)
    {
        return str_replace(" ", "", stripslashes(strip_tags(trim($input))));
    }
}