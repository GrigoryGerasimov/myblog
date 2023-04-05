<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Auths\NativeAuth;

use Rehor\Myblog\models\Auths\NativeAuth\interfaces\NativeAuthInterface;
use Rehor\Myblog\models\Auths\Auth\Auth;
use Rehor\Myblog\controllers\DBController\DBController;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorDoctrineRepository\DBConnectorDoctrineRepository;
use Rehor\Myblog\repositories\SessionRepository\SessionRepository;
use Rehor\Myblog\entities\User;

final class NativeAuth extends Auth implements NativeAuthInterface
{
    public static function triggerRegistration(object $requestData): void
    {
        $newUser = new User();
        $newUser->email = $requestData["email"];
        $newUser->password = md5($requestData["password"]);
        $newUser->username = $requestData["username"];
        $newUser->firstname = $requestData["firstname"];
        $newUser->lastname = $requestData["lastname"];
        $newUser->roles_mask = $requestData["role"];
        $newUser->verified = true;
        $newUser->registered = time();
        $newUser->last_login = $newUser->registered;
        
        DBConnectorDoctrineRepository::updateConnector(DBController::getDBName(), $newUser);
        
        $createdUser = DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\User", [ "email" => $requestData["email"] ]);
        
        if (!is_null($createdUser)) {
            
            SessionRepository::setSession([
                "user_id" => $createdUser->id,
                "user_email" => $createdUser->email,
                "user_password" => $createdUser->password,
                "user_username" => $createdUser->username,
                "user_firstname" => $createdUser->firstname,
                "user_lastname" => $createdUser->lastname,
                "user_role" => $createdUser->roles_mask
            ]);
            
        }
    }
    
    public static function triggerLogin(?string $email = null, ?string $password = null): void
    {
        $user = DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\User", [ "email" => $email ]);
        
        if (!is_null($email) && !is_null($password)) {
            
            $hashedPassword = md5($password);
            
            $sessionData = [
                "user_id" => $user->id,
                "user_email" => $user->email,
                "user_password" => $user->password,
                "user_username" => $user->username,
                "user_firstname" => $user->firstname,
                "user_lastname" => $user->lastname,
                "user_role" => $user->roles_mask
            ];
            
            if (!is_null($user) && $email === $user->email && $hashedPassword === $user->password) {
                
                SessionRepository::setSession($sessionData);
                
                $user->last_login = time();
                
                DBConnectorDoctrineRepository::updateConnector(DBController::getDBName(), $user);
                
            } else {
                
                throw new \Exception("Sign in failed! Your email or password is incorrect");
                
            }
        } else {
            
            header("Location: /login");
            exit();
            
        }
    }
    
    public static function triggerLogout(): void
    {
        SessionRepository::unsetSession();
        
        if (SessionRepository::validateSession()) {
            
            throw new \Exception("Logout failed");
            
        }
    }
    
    public static function retrieveSession(): array
    {
        return SessionRepository::getSession();
    }
    
    public static function isAdmin(): bool
    {
        $currentSession = SessionRepository::getSession();
        
        if (count($currentSession) !== 0) {
            
            $userRole = $currentSession["user_role"];
            
            $role = DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\Role", [ "id" => $userRole ]);
            $sessionData["isAdmin"] = $role->permission;
            
            return $role->permission;
        }
        
        return false;
    }
    
    public static function getAuthUserId(): ?int
    {
        if (SessionRepository::getSession()) {
            
            if (array_key_exists("user_id", SessionRepository::getSession()) && !empty(SessionRepository::getSession()["user_id"])) {
                
                return SessionRepository::getSession()["user_id"];
            
            }
        }
        
        return null;
        
    }
    
    public static function getAuthUserEmail(): ?string
    {
        if (SessionRepository::getSession()) {
            
            if (array_key_exists("user_email", SessionRepository::getSession()) && !empty(SessionRepository::getSession()["user_email"])) {
                
                return SessionRepository::getSession()["user_email"];
                
            }
        }
        
        return null;
    }
    
    public static function getAuthUsername(): ?string
    {
        if (SessionRepository::getSession()) {
            
            if (array_key_exists("user_username", SessionRepository::getSession()) && !empty(SessionRepository::getSession()["user_username"])) {
                
                return SessionRepository::getSession()["user_username"];
                
            }
        }
        
        return null;
    }
    
    public static function createUserAsAdmin(): void
    {
        
    }
}