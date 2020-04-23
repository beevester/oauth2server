<?php


namespace App\Interfaces;

use App\Entity\Object\UserId;

interface CheckerIdInterface
{
    /**
     * @param UserId $userId
     * @return bool
     */
    public function isUnique(UserId $userId): bool;
}
