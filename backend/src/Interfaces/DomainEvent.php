<?php


namespace App\Interfaces;

interface DomainEvent
{
    /**
     * @return AggregateId
     */
    public function getAggregateId(): AggregateId;
}
