<?php


namespace App\Model;


class ExecuteRegisterConfirmation
{
    /**
     * @var string
     */
    public $email;
    /**
     * @var string
     */
    public $token;

    /**
     * ExecuteRegisterConfirmation constructor.
     */
    public function __construct(string $email, string $token)
    {
        $this->email = $email;
        $this->token = $token;
    }
}
