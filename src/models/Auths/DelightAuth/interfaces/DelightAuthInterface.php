<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Auths\DelightAuth\interfaces;

use Rehor\Myblog\models\Auths\Auth\interfaces\AuthInterface;

interface DelightAuthInterface extends AuthInterface
{
    public static function init(): object;
    
    public static function triggerRegistration(object $requestData): int;
    
    public static function verifyRegisteredEmail(string $selector, string $token): array;
    
    public static function triggerForgottenPasswordReset(string $email): void;
    
    public static function resetForgottenPassword(string $selector, string $token, string $password): void;
}