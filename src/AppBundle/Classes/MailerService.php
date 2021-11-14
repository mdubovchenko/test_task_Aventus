<?php

namespace AppBundle\Classes;

use Swift_Mailer;
use Swift_Message;

/**
 * Class MailerService
 * @package AppBundle\Classes
 */
class MailerService
{
    /** @var Swift_Mailer  */
    private $mailer;

    public function __construct()
    {
        $transport = (new \Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
            ->setUsername('example@gmail.com')
            ->setPassword('password');
        $this->mailer = new Swift_Mailer($transport);
    }

    /**
     * @param string $clientEmail
     * @param string $category
     * @param string $joke
     */
    public function sendMail(string $clientEmail, string $category, string $joke): void
    {
        $message = (new Swift_Message("Случайная шутка из {$category}"))
            ->setFrom('example@gmail.com')
            ->setTo($clientEmail)
            ->setBody($joke,'text/html');
        $this->mailer->send($message);
    }
}