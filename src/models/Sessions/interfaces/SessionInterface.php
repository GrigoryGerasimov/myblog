<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Sessions\interfaces;

interface SessionInterface
{
    public function init_session();
    
    public function set_session(array $params): void;
    
    public function get_session(): array;
    
    public function unset_session(): void;
    
    public function is_session_valid(): bool;
}