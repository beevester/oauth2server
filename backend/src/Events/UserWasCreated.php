<?php

namespace App\Events;

use App\Entity\Object\Name;
use App\Entity\Object\UserId;
use App\Interfaces\AggregateId;
use App\Interfaces\DomainEvent;

class UserWasCreated implements DomainEvent
{
    private UserId $userId;
    private Name $name;

    /**
     * UserWasCreated constructor.
     * @param UserId $userId
     * @param Name $name
     */
    public function __construct(UserId $userId, Name $name)
    {
        $this->userId = $userId;
        $this->name = $name;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return AggregateId
     */
    public function getAggregateId(): AggregateId
    {
        return $this->userId;
    }
}
