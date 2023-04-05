<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Sessions;

use Rehor\Myblog\models\Sessions\interfaces\SessionInterface;
use Rehor\Myblog\models\Sessions\sessions\SessionNative;
use Rehor\Myblog\models\Sessions\sessions\SessionDelight;

class Session implements SessionInterface
{    
    public function init_session()
    {
        SessionDelight::initSession();
    }

    public function set_session(array $params): void
    {
        SessionDelight::setSession($params);
    }
    
    public function get_session(): array
    {
        return SessionDelight::getSession();
    }
    
    public function unset_session(): void
    {
        SessionDelight::unsetSession();
    }
    
    public function is_session_valid(): bool
    {
        return SessionDelight::validateSession();
    }
}