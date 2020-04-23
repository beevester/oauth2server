<?php


namespace App\Security;

use App\Entity\Object\UserId;
use App\Interfaces\UserRepositoryInterface;
use Exception;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class ProfileProvider implements UserProviderInterface
{
    private UserRepositoryInterface $repository;

    /**
     * UserProvider constructor.
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function loadUserByUsername(string $username): UserInterface
    {
        $user = $this->repository->userOfId(UserId::fromString($username));

        if (($email = $user->getEmail())) {
            return new ProfileByEmail(
                $user->getId(),
                $email,
                $user->getPassword(),
                $user->getStatus()
            );
        }

        throw new UsernameNotFoundException('email not found');
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function refreshUser(UserInterface $user): UserInterface
    {
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * @inheritDoc
     */
    public function supportsClass(string $class): bool
    {
        return ProfileByEmail::class === $class;
    }
}
