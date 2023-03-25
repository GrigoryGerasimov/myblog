<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Session;

use Rehor\Myblog\models\Session\interfaces\SessionInterface;

class Session implements SessionInterface
{
    public function set_session(array $params): void
    {
        foreach($params as $param_key => $param_value) {
            if (!is_null($param_value)) {
                $_SESSION[$param_key] = $param_value;
            }
        }
    }
    
    public function unset_session(): void
    {
        foreach($_SESSION as $session_key => &$session_value) {
            if (!empty($session_value)) {
                $session_value = null;
            }
        }
    }
    
    public function is_session_valid(): bool
    {
        [
        "user_id" => $session_id,
        "user_email" => $session_email,
        "user_password" => $session_password
        ] = $_SESSION;
        
        return !empty($session_id) && !empty($session_email) && !empty($session_password);
    }
}