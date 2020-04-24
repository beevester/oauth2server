<?php


namespace App\Interfaces;


use App\Entity\Object\Email;
use App\Entity\Object\UserId;
use App\Entity\User;
use App\Events\AggregateRoot;

class test implements PasswordEncodedInterface
{

    /**
     * @param UserId $userId
     * @return User
     */
    public function userOfId(UserId $userId): User
    {
        // TODO: Implement userOfId() method.
    }

    /**
     * @param Email $email
     * @return User
     */
    public function userOfEmail(Email $email): User
    {
        // TODO: Implement userOfEmail() method.
    }

    /**
     * @return UserId
     */
    public function nextIdentity(): UserId
    {
        // TODO: Implement nextIdentity() method.
    }

    /**
     * @param AggregateRoot $user
     */
    public function add(AggregateRoot $user): void
    {
        // TODO: Implement add() method.
    }

    /**
     * @param UserId $userId
     * @return bool
     */
    public function isUnique(UserId $userId): bool
    {
        // TODO: Implement isUnique() method.
    }

    /**
     * @param string $password
     * @return string
     */
    public function hash(string $password): string
    {
        // TODO: Implement hash() method.
    }

    /**
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public function validate(string $password, string $hash): bool
    {
        // TODO: Implement validate() method.
    }
}
