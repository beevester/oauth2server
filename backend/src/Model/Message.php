<?php


namespace App\Model;


class Message
{
    private object $event;

    /**
     * Message constructor.
     * @param object $event
     */
    public function __construct(object $event)
    {
        $this->event = $event;
    }

    /**
     * @return object
     */
    public function getEvent(): object
    {
        return $this->event;
    }
}
