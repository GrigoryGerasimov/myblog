<?php

declare(strict_types=1);

namespace Rehor\Myblog\utils\arrays;

function flattenArray(array $array): array
{
    $result = [];
    $intermediateArray = $array;

    array_walk_recursive($intermediateArray, function($value, $key) use(&$result) {
        $result[$key] = $value;
    });

    return $result;
}