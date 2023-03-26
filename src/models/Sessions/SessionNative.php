<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Sessions;

class SessionNative
{
    public static function initSession()
    {
        session_start();
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
        foreach($_SESSION as $session_key => &$session_value) {
            if (!empty($session_value)) {
                $session_value = null;
            }
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
