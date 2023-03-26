<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Renderer\interfaces;

interface RendererInterface
{
    public static function trigger(string $view, array $renderData): void;
}