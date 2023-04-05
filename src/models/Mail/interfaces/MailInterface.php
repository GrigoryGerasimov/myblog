<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Mail\interfaces;

interface MailInterface
{
    public static function init();
    
    public static function configureMailer(): void;
    
    public static function send(string $mailId, string $subject, string $content): void;
}