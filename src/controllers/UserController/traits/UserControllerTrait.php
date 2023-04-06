<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\UserController\traits;

trait UserControllerTrait
{
    public static function handleUserInput(string $input): string
    {
        return str_replace(" ", "", stripslashes(strip_tags(trim($input))));
    }
    
    public static function handlePasswordCheck(string $password): bool
    {
        $bannedPasswordCombinations = [
            "password",
            "test",
            "12345",
            "password12345",
            "username",
            "admin"
        ];
        
        if (strlen($password) < 8) {
            
            throw new \Exception("Password should contain 8 or more characters");
            
        } elseif (in_array($password, $bannedPasswordCombinations)) {
            
            throw new \Exception("The current password is not recommended for security reasons. Please create a stronger password");
            
        } else return true;
    }
}