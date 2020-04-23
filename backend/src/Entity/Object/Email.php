<?php


namespace App\Entity\Object;

use Exception;

final class Email
{
    private string $email;

    /**
     * Email constructor.
     * @param string $email
     * @throws Exception
     */
    private function __construct(string $email)
    {
        $this->setEmail($email);
    }

    /**
     * @param string $email
     * @return Email
     * @throws Exception
     */
    public static function fromString(string $email): self
    {

        $self = new self($email);
        return $self;
    }

    public function equals(Email $other): bool
    {
        return $other instanceof self && $other->email === $this->email;
    }


    /**
     * @param string $email
     * @throws Exception
     */
    private function setEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception();
        }

        $this->email = mb_strtolower($email);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->email;
    }
}
