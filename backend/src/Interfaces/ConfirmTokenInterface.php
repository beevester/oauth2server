<?php


namespace App\Interfaces;


use App\Entity\Object\ConfirmationToken;

interface ConfirmTokenInterface
{
    /**
     * @return ConfirmationToken
     */
    public function generate(): ConfirmationToken;
}
