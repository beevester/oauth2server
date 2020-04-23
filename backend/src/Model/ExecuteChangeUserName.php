<?php


namespace App\Model;


class ExecuteChangeUserName
{
    public string $id;
    public string $firstName;
    public ?string $lastName;

    /**
     * ChangeUserNameCommand constructor.
     * @param string $id
     * @param string $firstName
     * @param string|null $lastName
     */
    public function __construct(string $id, string $firstName, ?string $lastName)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }
}
