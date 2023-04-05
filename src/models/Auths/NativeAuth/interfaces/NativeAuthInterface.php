<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Auths\NativeAuth\interfaces;

use Rehor\Myblog\models\Auths\Auth\interfaces\AuthInterface;

interface NativeAuthInterface extends AuthInterface
{
    public static function triggerRegistration(object $requestData): void;
}