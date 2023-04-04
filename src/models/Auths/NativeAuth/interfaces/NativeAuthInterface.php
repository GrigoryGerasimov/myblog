<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Auths\NativeAuth\interfaces;

interface NativeAuthInterface
{    
    public static function triggerRegistration(object $requestData): void;
    
    public static function triggerLogin(?string $email = null, ?string $password = null): void;
    
    public static function triggerLogout(): void;
}