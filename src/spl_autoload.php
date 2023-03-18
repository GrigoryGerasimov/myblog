<?php

declare(strict_types=1);

function customAutoloader(string $class): void
{
    $class = str_replace("\\", "/", $class).".php";
    require_once($class);
}

spl_autoload_register("customAutoloader");