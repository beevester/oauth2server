<?php


namespace App\Events;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailNotifSubscriber implements EventSubscriberInterface
{
    private MailerInterface $mailer;

    /**
     * EmailNotificationSubscriber constructor.
     * @param MailerInterface $mailer
     */
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            UserRegisteredByEmail::class => [
                ['onUserSignedUpByEmail']
            ]
        ];
    }


    /**
     * @param UserRegisteredByEmail $event
     * @throws TransportExceptionInterface
     */
    public function onUserSignedUpByEmail(UserRegisteredByEmail $event): void
    {
        $email = (new Email())
            ->from('tes@ax.com')
            ->to((string)$event->getEmail())
            ->subject('Confirm Token')
            ->text("Token: {$event->getConfirmationToken()->token()}");

        $this->mailer->send($email);
    }
}
