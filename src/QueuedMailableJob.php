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

use Hyperf\AsyncQueue\Job;
use Hyperf\Context\ApplicationContext;
use MsPro\Mail\Contracts\MailableInterface;
use MsPro\Mail\Contracts\MailManagerInterface;

class QueuedMailableJob extends Job
{
    public function __construct(public MailableInterface $mailable)
    {
    }

    public function handle()
    {
        $this->mailable->send(ApplicationContext::getContainer()->get(MailManagerInterface::class));
    }
}
