<?php


namespace App\Interfaces;


interface EventDispatcherInterface
{
    /**
     * @param array $events
     */
    public function dispatch(array $events): void;
}
