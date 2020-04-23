<?php


namespace App\Interfaces;


use App\Entity\Object\Email;

interface CheckEmailInterface
{
    /**
     * @param Email $email
     * @return bool
     */
    public function isUnique(Email $email): bool;
}
