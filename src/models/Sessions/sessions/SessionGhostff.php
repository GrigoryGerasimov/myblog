<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Sessions\sessions;

class SessionGhostff extends Sessions
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
        $sessionResult = [];

        $sessionArray = self::$sessionInstance->getAll();
        array_walk_recursive($sessionArray, function($value, $key) use(&$sessionResult) { $sessionResult[$key] = $value; });

        return $sessionResult;
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
