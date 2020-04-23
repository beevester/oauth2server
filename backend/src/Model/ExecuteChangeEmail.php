<?php

namespace App\Model;

class ExecuteChangeEmail
{
    public string $id;
    public string $email;

    /**
     * ChangeEmailCommand constructor.
     * @param string $id
     * @param string $email
     */
    public function __construct(string $id, string $email)
    {
        $this->id = $id;
        $this->email = $email;
    }
}
