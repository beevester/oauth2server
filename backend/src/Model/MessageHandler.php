<?php


namespace App\Model;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class MessageHandler
{
    private EventDispatcherInterface $dispatcher;

    /**
     * Handler constructor.
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param Message $message
     */
    public function __invoke(Message $message): void
    {
        $this->dispatcher->dispatch($message->getEvent());
    }
}
