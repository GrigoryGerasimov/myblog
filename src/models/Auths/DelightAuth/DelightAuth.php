<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Auths\DelightAuth;

use Rehor\Myblog\models\Auths\DelightAuth\interfaces\DelightAuthInterface;
use Rehor\Myblog\models\Auths\Auth\Auth;
use Rehor\Myblog\config\Config;
use Rehor\Myblog\controllers\MailController\MailController;
use Rehor\Myblog\controllers\DBController\DBController;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorDoctrineRepository\DBConnectorDoctrineRepository;
use Rehor\Myblog\repositories\SessionRepository\SessionRepository;
use Rehor\Myblog\entities\User;

final class DelightAuth extends Auth implements DelightAuthInterface
{
    protected static $auth;
    
    private function __construct()
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
    
    public static function triggerRegistration(object $requestData): int
    {
        try {
            $requestDataAssoc = json_decode(json_encode($requestData), true);
            
            extract($requestDataAssoc, EXTR_SKIP);
            
            $createdUserId = self::init()->registerWithUniqueUsername($email, $password, $username, function($selector, $token) use($email) {
               
                $verificationURL = "http://localhost:6500/check/verify_email?selector=".urlencode($selector)."&token=".urlencode($token);
                
                MailController::mail($email, "Verify your MyBlog account", $verificationURL);
                
            });
            
            $createdUser = DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\User", [ "id" => $createdUserId ]);
            
            if (!is_null($createdUser)) {
                $createdUser->firstname = $firstname;
                $createdUser->lastname = $lastname;
                $createdUser->roles_mask = $role;
                $createdUser->verified = true;
                $createdUser->last_login = time();
            }
            
            DBConnectorDoctrineRepository::updateConnector(DBController::getDBName(), $createdUser);
            
            return $createdUserId;
            
        } catch (\Delight\Auth\DuplicateUsernameException $e) {
            
            throw new \Exception("Duplicate usernames are not allowed");
            
        } catch (\Delight\Auth\InvalidEmailException $e) {
            
            throw new \Exception("Email address or password are incorrect");
            
        } catch (\Delight\Auth\InvalidPasswordException $e) {
            
            throw new \Exception("Email address or password are incorrect");
        
        } catch (\Delight\Auth\UserAlreadyExistsException $e) {
            
            throw new \Exception("User is already registered with the same email address");
        
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            
            throw new \Exception("Too many requests. Please try again later");
        }
    }
    
    public static function triggerLogin(?string $email = null, ?string $password = null, ?string $remember = null): void
    {
        if (!is_null($email) && !is_null($password)) {
            
            try {
                $rememberDuration = null;
                
                if ($remember === "on") {
                    $rememberDuration = 60 * 60 * 24;
                }
                
                self::init()->login($email, $password, $rememberDuration);
            
                $currentUser = DBConnectorDoctrineRepository::retrieveOneFromConnector(DBController::getDBName(), "Rehor\Myblog\\entities\User", [ "email" => $email ]);
            
                $currentUser->last_login = time();
            
                DBConnectorDoctrineRepository::updateConnector(DBController::getDBName(), $currentUser);
            
                $sessionData = [
                    "user_id" => $currentUser->id,
                    "user_email" => $currentUser->email,
                    "user_password" => $currentUser->password,
                    "user_username" => $currentUser->username,
                    "user_firstname" => $currentUser->firstname,
                    "user_lastname" => $currentUser->lastname,
                    "user_role" => $currentUser->roles_mask
                ];
      
                SessionRepository::setSession($sessionData);
            
            } catch (\Delight\Auth\InvalidEmailException $e) {
            
                throw new \Exception("Email address or password are incorrect");
        
            } catch (\Delight\Auth\InvalidPasswordException $e) {
            
                throw new \Exception("Email address or password are incorrect");
        
            } catch (\Delight\Auth\EmailNotVerifiedException $e) {
            
                throw new \Exception("Email address has not been verified");
        
            } catch (\Delight\Auth\AttemptCancelledException $e) {
            
                throw new \Exception("Attempt has been cancelled");
        
            } catch (\Delight\Auth\TooManyRequestsException $e) {
            
                throw new \Exception("Too many requests. Please try again later");
        
            }
        
        } else {
            
            header("Location: /login");
            exit();
            
        }
    }
    
    public static function triggerLogout(): void
    {
        try {
            
            self::init()->logOutEverywhere();
            
            self::init()->destroySession();
            
        } catch (\Delight\Auth\NotLoggedInException $e) {
            
            die("You are currently not signed in. Please sign in first to be able to sign out");
            
        }
    }
    
    public static function verifyRegisteredEmail(): array
    {
        try {
            
            return self::init()->confirmEmail($_GET("selector"), $_GET("token"));
            
        } catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
            
            throw new \Exception("Invalid token");
            
        } catch (\Delight\Auth\TokenExpiredException $e) {
            
            throw new \Exception("Token expired");
            
        } catch (\Delight\Auth\UserAlreadyExistsException $e) {
            
            throw new \Exception("Email address is already registered");
        
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            
            throw new \Exception("Too many requests. Please try once again later");
            
        }
        
    }
    
    public static function getAuthUserId(): ?int
    {
        return self::init()->getUserId();
    }
    
    public static function getAuthUserEmail(): ?string
    {
        return self::init()->getEmail();
    }
    
    public static function getAuthUsername(): ?string
    {
        return self::init()->getUsername();
    }
    
    public static function isAdmin(): bool
    {
        return self::init()->hasAnyRole(...[
            \Delight\Auth\Role::ADMIN,
            \Delight\Auth\Role::DIRECTOR,
            \Delight\Auth\Role::MODERATOR,
            \Delight\Auth\Role::MANAGER,
            \Delight\Auth\Role::SUPER_ADMIN,
            \Delight\Auth\Role::SUPER_EDITOR,
            \Delight\Auth\Role::SUPER_MODERATOR
        ]);
    }
    
    public static function createUserAsAdmin(): void
    {
        
    }
}