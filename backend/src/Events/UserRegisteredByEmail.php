<?php


namespace App\Events;


use App\Entity\Object\ConfirmationToken;
use App\Entity\Object\Email;
use App\Entity\Object\Name;
use App\Entity\Object\UserId;
use App\Interfaces\AggregateId;
use App\Interfaces\DomainEvent;

class UserRegisteredByEmail implements DomainEvent
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
     * @var Name
     */
    private $name;
    /**
     * @var ConfirmationToken
     */
    private $confirmationToken;

    /**
     * UserRegisteredByEmail constructor.
     * @param UserId $userId
     * @param Email $email
     * @param Name $name
     * @param ConfirmationToken $confirmationToken
     */
    public function __construct(
        UserId $userId,
        Email $email,
        Name $name,
        ConfirmationToken $confirmationToken
    )
    {
        $this->userId = $userId;
        $this->email = $email;
        $this->name = $name;
        $this->confirmationToken = $confirmationToken;
    }

    public function getAggregateId(): AggregateId
    {
        return $this->userId;
    }

    /**
     * @return UserId
     */
    public function getUserId(): UserId
    {
        return $this->userId;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return ConfirmationToken
     */
    public function getConfirmationToken(): ConfirmationToken
    {
        return $this->confirmationToken;
    }
}
