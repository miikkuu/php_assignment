<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendUserDataStoredEmail(string $to): void
    {
        $email = (new Email())
            ->from('admin@example.com')
            ->to($to)
            ->subject('User Data Stored')
            ->text('Your user data has been successfully stored in our database.');

        $this->mailer->send($email);
    }
}