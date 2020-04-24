<?php


namespace App\Repository;


use App\Entity\Object\Email;
use App\Interfaces\CheckEmailInterface;

class CheckEmailRepository implements CheckEmailInterface
{

    /**
     * @param Email $email
     * @return bool
     */
    public function isUnique(Email $email): bool
    {
        // TODO: Implement isUnique() method.
    }
}
