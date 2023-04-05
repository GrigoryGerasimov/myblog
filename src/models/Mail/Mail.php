<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Mail;

use Rehor\Myblog\models\Mail\interfaces\MailInterface;
use \PHPMailer\PHPMailer\{PHPMailer, Exception};

final class Mail implements MailInterface
{
    protected static $mailer;
    
    private function __construct()
    {
        self::$mailer = new PHPMailer(true);
    }
    
    public static function init()
    {
        if (is_null(self::$mailer)) {
            
            new self();
            
        }
        
        return self::$mailer;
    }
    
    public static function configureMailer(): void
    {
        self::init()->isSMTP();
        self::init()->Host = "sandbox.smtp.mailtrap.io";
        self::init()->SMTPAuth = true;
        self::init()->Post = 2525;
        self::init()->Username = "aa9c60dce43c99";
        self::init()->Password = "7df8b799a40e95";
        
        self::init()->setFrom("rehor.ger@gmail.com", "Grigory TestAdmin");
        self::init()->addReplyTo("rehor.ger@gmail.com");
        
        self::init()->isHTML(false);
    }
    
    public static function send(string $mailId, string $subject, string $content): void
    {
        try {
            
            self::configureMailer();
            
            self::init()->addAddress($mailId);
            self::init()->Subject = $subject;
            self::init()->Body = $content;
            self::init()->AltBody = $content;
            
            self::init()->send();
            
        } catch (Exception $e) {
            
            echo $e->getMessage()."Error Info: ".self::init()->ErrorInfo;
            
        }
    }
}