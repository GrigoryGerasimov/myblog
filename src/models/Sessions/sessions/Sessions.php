<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Sessions\sessions;

abstract class Sessions
{
    abstract public static function initSession();

    abstract public static function setSession(array $params): void;

    abstract public static function getSession(): array;

    abstract public static function unsetSession(): void;

    abstract public static function validateSession(): bool;
}