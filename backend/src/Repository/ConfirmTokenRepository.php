<?php

namespace App\Repository;

use App\Entity\Object\ConfirmationToken;
use App\Interfaces\ConfirmTokenInterface;

class ConfirmTokenRepository implements ConfirmTokenInterface
{

    /**
     * @return ConfirmationToken
     */
    public function generate(): ConfirmationToken
    {
        // TODO: Implement generate() method.
    }
}
