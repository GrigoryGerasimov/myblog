<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Renderer;

use Rehor\Myblog\models\Renderer\interfaces\RendererInterface;

class Renderer implements RendererInterface
{
    public static function trigger(string $view, array $renderData): void
    {
        \Flight::view()->display($view, $renderData);
    }
}