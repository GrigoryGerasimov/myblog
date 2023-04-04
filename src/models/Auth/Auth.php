<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Auth;

use Rehor\Myblog\models\Auth\interfaces\AuthInterface;
use Rehor\Myblog\config\Config;
use Rehor\Myblog\controllers\DBController\DBController;

class Auth implements AuthInterface
{
    protected static $auth;
    
    public function __construct()
    {
        self::$auth = Config::setPHPAuth(DBController::getDBName());
    }
    
    public static function init(): object
    {
        if (is_null(self::$auth)) {
            new self();
        }
        
        return self::$auth;
    }
    
    public static function triggerRegistration(string $email, string $password, string $username, ?callable $fn = null): void
    {
        self::init()->register($email, $password, $username, $fn);
    }
    
    public static function triggerLogin(string $email, string $password): void
    {
        self::init()->login($email, $password);
    }
}