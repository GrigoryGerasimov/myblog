<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\RendererRepository;

use Rehor\Myblog\repositories\RendererRepository\interfaces\RendererRepositoryInterface;
use Rehor\Myblog\models\Renderer\Renderer;

class RendererRepository implements RendererRepositoryInterface
{
    public static function displayView(string $view, array $renderData): void
    {
        Renderer::trigger($view, $renderData);
    }
}