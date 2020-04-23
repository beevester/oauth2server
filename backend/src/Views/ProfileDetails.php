<?php


namespace App\Views;


final class ProfileDetails
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $firstName;
    /**
     * @var string|null
     */
    private $lastname;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $status;
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     */
    private $createdOn;

    /**
     * ProfileDetails constructor.
     * @param string $id
     * @param string $firstName
     * @param string|null $lastname
     * @param string $email
     * @param string $status
     * @param string $password
     * @param string $createdOn
     */
    public function __construct(
        string $id,
        string $firstName,
        ?string $lastname,
        string $email,
        string $status,
        string $password,
        string $createdOn
    )
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->status = $status;
        $this->password = $password;
        $this->createdOn = $createdOn;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getCreatedOn(): string
    {
        return $this->createdOn;
    }
}
