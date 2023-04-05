<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\MailController\interfaces;

interface MailControllerInterface
{
    public static function mail(string $recipient, string $subject, string $content): void;
}