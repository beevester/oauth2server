<?php


namespace App\Events;


use App\Entity\Object\Name;
use App\Entity\Object\UserId;
use App\Interfaces\AggregateId;
use App\Interfaces\DomainEvent;

class UserNameWasChanged implements DomainEvent
{
    /**
     * @var UserId
     */
    private $id;
    /**
     * @var Name
     */
    private $name;

    /**
     * UserNameWasChanged constructor.
     * @param UserId $id
     * @param Name $name
     */
    public function __construct(UserId $id, Name $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return AggregateId
     */
    public function getAggregateId(): AggregateId
    {
        return $this->id;
    }
}
