<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Session\interfaces;

interface SessionInterface
{
    public function set_session(array $params): void;
    
    public function unset_session(): void;
    
    public function is_session_valid(): bool;
}