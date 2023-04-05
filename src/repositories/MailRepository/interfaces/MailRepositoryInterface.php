<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\MailRepository\interfaces;

interface MailRepositoryInterface
{
    public static function processMailSending(string $mailId, string $subject, string $content): void;
}