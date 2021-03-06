<?php


namespace App\Model;

class ExecuteCreateUser
{
    public string $firstName;
    public ?string $lastName;
    public string $password;

    /**
     * CreateUserCommand constructor.
     * @param string $firstName
     * @param string|null $lastName
     * @param string $password
     */
    public function __construct(
        string $firstName,
        ?string $lastName,
        string $password
    ) {
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }
}
