<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\MailRepository;

use Rehor\Myblog\repositories\MailRepository\interfaces\MailRepositoryInterface;
use Rehor\Myblog\models\Mail\Mail;

final class MailRepository implements MailRepositoryInterface
{
    public static function processMailSending(string $mailId, string $subject, string $content): void
    {
        Mail::send($mailId, $subject, $content);
    }
}