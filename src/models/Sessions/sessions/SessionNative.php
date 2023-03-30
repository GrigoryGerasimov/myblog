<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Sessions\sessions;

class SessionNative extends Sessions
{
    public static function initSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    public static function setSession(array $params): void
    {
        foreach($params as $param_key => $param_value) {
            if (!is_null($param_value)) {
                $_SESSION[$param_key] = $param_value;
            }
        }
    }
    
    public static function getSession(): array
    {
        return $_SESSION;
    }
    
    public static function unsetSession(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_unset();
        }
    }
    
    public static function validateSession(): bool
    {
        if (!empty($_SESSION)) {
            [
            "user_id" => $session_id,
            "user_email" => $session_email,
            "user_password" => $session_password
            ] = $_SESSION;
            
            return !empty($session_id) && !empty($session_email) && !empty($session_password);
        } else {
            return false;
        }
    }
}
