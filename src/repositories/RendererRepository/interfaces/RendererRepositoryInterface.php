<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\RendererRepository\interfaces;

interface RendererRepositoryInterface
{
    public static function displayView(string $view, array $renderData): void;
}