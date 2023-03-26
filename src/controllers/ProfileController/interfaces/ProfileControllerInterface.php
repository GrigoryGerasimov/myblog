<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\ProfileController\interfaces;

interface ProfileControllerInterface
{
    public static function isAuthorized();
    
    public static function showProfile();
    
    public static function updateProfile();
    
    public static function removeProfile();
}