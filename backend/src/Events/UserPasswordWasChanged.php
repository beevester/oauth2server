<?php


namespace App\Events;


use App\Entity\Object\UserId;
use App\Interfaces\AggregateId;
use App\Interfaces\DomainEvent;

class UserPasswordWasChanged implements DomainEvent
{
    /**
     * @var UserId
     */
    private $userId;

    /**
     * UserPasswordWasChanged constructor.
     * @param UserId $userId
     */
    public function __construct(UserId $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return AggregateId
     */
    public function getAggregateId(): AggregateId
    {
        return $this->userId;
    }
}
