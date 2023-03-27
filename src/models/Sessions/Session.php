<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Sessions;

use Rehor\Myblog\models\Sessions\interfaces\SessionInterface;
use Rehor\Myblog\models\Sessions\sessions\SessionNative;

class Session implements SessionInterface
{    
    public function init_session()
    {
        SessionNative::initSession();
    }

    public function set_session(array $params): void
    {
        SessionNative::setSession($params);
    }
    
    public function get_session(): array
    {
        return SessionNative::getSession();
    }
    
    public function unset_session(): void
    {
        SessionNative::unsetSession();
    }
    
    public function is_session_valid(): bool
    {
        return SessionNative::validateSession();
    }
}