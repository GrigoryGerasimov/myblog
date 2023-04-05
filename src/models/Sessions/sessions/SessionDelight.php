<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Sessions\sessions;

use \Delight\Cookie\Session;

final class SessionDelight extends Sessions
{
    public static function initSession()
    {
        Session::start();
    }
    
    public static function setSession(array $params): void
    {
        foreach($params as $key => $value) {
            
            if (!is_null($value)) {
                Session::set($key, $value);
            }
            
        }
    }
    
    public static function getSession(): array
    {
        return $_SESSION;
    }
    
    public static function unsetSession(): void
    {
        foreach($_SESSION as $session_key => $session_value) {
            
            if (isset($session_key)) {
                Session::delete($session_key);
            }
            
        }
    }
    
    public static function validateSession(): bool
    {
        return Session::has("user_id") && Session::has("user_email") && Session::has("user_username");
    }
}