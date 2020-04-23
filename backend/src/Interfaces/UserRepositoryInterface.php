<?php

namespace App\Interfaces;

use App\Entity\Object\Email;
use App\Entity\Object\UserId;
use App\Entity\User;
use App\Events\AggregateRoot;

interface UserRepositoryInterface
{
    /**
     * @param UserId $userId
     * @return User
     */
    public function userOfId(UserId $userId): User;

    /**
     * @param Email $email
     * @return User
     */
    public function userOfEmail(Email $email): User;

    /**
     * @return UserId
     */
    public function nextIdentity(): UserId;

    /**
     * @param AggregateRoot $user
     */
    public function add(AggregateRoot $user): void;
}
