<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\SessionRepository;

use Rehor\Myblog\repositories\SessionRepository\interfaces\SessionRepositoryInterface;
use Rehor\Myblog\models\Sessions\Session;

class SessionRepository implements SessionRepositoryInterface
{
    public static function getSessionInstance()
    {
        return new Session();
    }
    
    public static function initSession()
    {
        self::getSessionInstance()->init_session();
    }
    
    public static function setSession(array $params): void
    {
        self::getSessionInstance()->set_session($params);
    }
    
    public static function getSession()
    {
        return self::getSessionInstance()->get_session();
    }
    
    public static function unsetSession(): void
    {
        self::getSessionInstance()->unset_session();
    }
    
    public static function validateSession(): bool
    {
        return self::getSessionInstance()->is_session_valid();
    }
}