<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Sessions\sessions;

require("utils/arrays/flattenArray.php");

use function Rehor\Myblog\utils\arrays\flattenArray;

final class SessionGhostff extends Sessions
{
    protected static $sessionInstance;
    
    private function __construct()
    {
        self::$sessionInstance = new \Ghostff\Session\Session();
    }
    
    public static function initSession()
    {
        if (empty(self::$sessionInstance)) {
            new self();
        }
    }
    
    public static function setSession(array $params): void
    {
        foreach($params as $param_key => $param_value) {
            if (!is_null($param_value)) {
                self::$sessionInstance->set($param_key, $param_value);
            }
        }
        
        self::$sessionInstance->commit();
    }
    
    public static function getSession(): array
    {
        return flattenArray(self::$sessionInstance->getAll());
    }
    
    public static function unsetSession(): void
    {
        self::$sessionInstance->clear();
        self::$sessionInstance->destroy();
    }
    
    public static function validateSession(): bool
    {
        return self::$sessionInstance->exist("user_id") && self::$sessionInstance->exist("user_email") && self::$sessionInstance->exist("user_password");
    }
}
