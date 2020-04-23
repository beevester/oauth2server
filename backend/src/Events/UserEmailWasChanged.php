<?php


namespace App\Events;

use App\Entity\Object\Email;
use App\Entity\Object\UserId;
use App\Interfaces\AggregateId;
use App\Interfaces\DomainEvent;

class UserEmailWasChanged implements DomainEvent
{
    /**
     * @var UserId
     */
    private $userId;
    /**
     * @var Email
     */
    private $email;

    /**
     * UserEmailWadChanged constructor.
     * @param UserId $userId
     * @param Email $email
     */
    public function __construct(UserId $userId, Email $email)
    {
        $this->userId = $userId;
        $this->email = $email;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return AggregateId
     */
    public function getAggregateId(): AggregateId
    {
        return $this->userId;
    }
}
