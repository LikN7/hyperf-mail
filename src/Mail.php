<?php

declare(strict_types=1);
/**
 * This file is part of hyperf-ext/mail.
 *
 * @link     https://github.com/hyperf-ext/mail
 * @contact  eric@zhu.email
 * @license  https://github.com/hyperf-ext/mail/blob/master/LICENSE
 */
namespace MsPro\Mail;

use Hyperf\Context\ApplicationContext;
use MsPro\Mail\Contracts\MailManagerInterface;

/**
 * @method static \MsPro\Mail\PendingMail to(mixed $users)
 * @method static \MsPro\Mail\PendingMail cc(mixed $users)
 * @method static \MsPro\Mail\PendingMail bcc(mixed $users)
 * @method static bool later(\MsPro\Mail\Contracts\MailableInterface $mailable, int $delay, ?string $queue = null)
 * @method static bool queue(\MsPro\Mail\Contracts\MailableInterface $mailable, ?string $queue = null)
 * @method static null|int send(\MsPro\Mail\Contracts\MailableInterface $mailable)
 *
 * @see \MsPro\Mail\MailManager
 */
abstract class Mail
{
    public static function __callStatic(string $method, array $args)
    {
        $instance = static::getManager();

        return $instance->{$method}(...$args);
    }

    public static function mailer(string $name): PendingMail
    {
        return new PendingMail(static::getManager()->get($name));
    }

    protected static function getManager(): MailManagerInterface
    {
        return ApplicationContext::getContainer()->get(MailManagerInterface::class);
    }
}
