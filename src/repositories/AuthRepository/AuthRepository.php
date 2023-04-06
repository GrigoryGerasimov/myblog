<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\AuthRepository;

use Rehor\Myblog\repositories\AuthRepository\interfaces\AuthRepositoryInterface;
use Rehor\Myblog\models\Auths\DelightAuth\DelightAuth;
use Rehor\Myblog\models\Auths\NativeAuth\NativeAuth;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorDoctrineRepository\DBConnectorDoctrineRepository;
use Rehor\Myblog\controllers\DBController\DBController;

final class AuthRepository implements AuthRepositoryInterface
{
    public static function processAuthRegistration(object $requestData)
    {
        return DelightAuth::triggerRegistration($requestData);
    }
    
    public static function processAuthLogin(?string $email = null, ?string $password = null, ?string $remember = null): void
    {
        DelightAuth::triggerLogin($email, $password, $remember);
    }
    
    public static function processAuthLogout(): void
    {
        DelightAuth::triggerLogout();
    }
    
    public static function retrieveAuthUserData(): array
    {
        $authUserId = DelightAuth::getAuthUserId();
        
        $authUserData = array(
            "user_id" => $authUserId,
            "user_email" => DelightAuth::getAuthUserEmail(),
            "user_username" => DelightAuth::getAuthUsername()
        );
        
        if ($authUserId) {
            
            $authUser = DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\User", [ "id" => $authUserId ]);
            
            $authUserFirstName = $authUser->firstname;
            $authUserLastName = $authUser->lastname;
            
            $authUserData["user_firstname"] = $authUserFirstName;
            $authUserData["user_lastname"] = $authUserLastName;
            
        }
        
        return $authUserData;
    }
    
    public static function verifyAuthRegisteredMail(string $selector, string $token): array
    {
        return DelightAuth::verifyRegisteredEmail($selector, $token);
    }
    
    public static function verifyAdminStatus(): bool
    {
        return DelightAuth::isAdmin();
    }
    
    public static function verifyAuthStatus(): bool
    {
        if (self::retrieveAuthUserData()) {
            
            if (!empty(self::retrieveAuthUserData()["user_id"])) {
                
                return true;
                
            }
        }
        
        return false;
    }
    
    public static function processUserCreationAsAdmin(): void
    {
        DelightAuth::createUserAsAdmin();
    }
}