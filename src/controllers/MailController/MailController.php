<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\MailController;

use Rehor\Myblog\controllers\MailController\interfaces\MailControllerInterface;
use Rehor\Myblog\repositories\MailRepository\MailRepository;

final class MailController implements MailControllerInterface
{
    public static function mail(string $recipient, string $subject, string $content): void
    {
        MailRepository::processMailSending($recipient, $subject, $content);
    }
}