<?php


namespace App\Security;

use App\Entity\Object\Status;
use App\Entity\Object\UserId;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ProfileById implements  UserInterface, EquatableInterface
{
    private UserId $id;
    private string $password;
    private Status $status;

    public function __construct(
        UserId $id,
        string $password,
        Status $status
    ) {
        $this->id = $id;
        $this->password = $password;
        $this->status = $status;
    }

    /**
     * @inheritDoc
     */
    public function isEqualTo(UserInterface $user): bool
    {
        if (!$user instanceof self) {
            return false;
        }

        return
            $this->id === $user->id &&
            $this->password === $user->password &&
            $this->status === $user->status;
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getRoles(): array
    {
        return [
            'ROLE_USER',
        ];
    }

    /**
     * @inheritDoc
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getUsername(): string
    {
        return (string)$this->id;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials(): void
    {
    }

    public function isActive(): bool
    {
        return $this->status->isActive();
    }
}
