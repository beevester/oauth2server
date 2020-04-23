<?php


namespace App\Model;

use App\Entity\Object\UserId;
use App\Interfaces\PasswordEncodedInterface;
use App\Interfaces\UserRepositoryInterface;

class ChangeUserPasswordHandler
{
    private UserRepositoryInterface $repository;
    private PasswordEncodedInterface $hasher;

    /**
     * ChangePasswordHandler constructor.
     * @param UserRepositoryInterface $repository
     * @param PasswordEncodedInterface $hasher
     */
    public function __construct(UserRepositoryInterface $repository, PasswordEncodedInterface $hasher)
    {
        $this->repository = $repository;
        $this->hasher = $hasher;
    }

    /**
     * @param ExecuteChangeUserPassword $command
     * @throws \Exception
     */
    public function handle(ExecuteChangeUserPassword $command): void
    {
        $user = $this->repository->userOfId(UserId::fromString($command->id));
        $user->changePassword($command->currentPassword, $command->newPassword, $this->hasher);

        $this->repository->add($user);
    }
}
