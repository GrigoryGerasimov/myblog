<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\SessionRepository\interfaces;

interface SessionRepositoryInterface
{
    public static function getSessionInstance();

    public static function setSession(array $params): void;
    
    public static function getSession(): array;
    
    public static function unsetSession(): void;
    
    public static function validateSession(): bool;
}