<?php

namespace App\Model;

use App\Entity\Object\Name;
use App\Entity\Object\UserId;
use App\Interfaces\UserRepositoryInterface;

class ChangeUserNameHandler
{
    private UserRepositoryInterface $repository;

    /**
     * ChangeUserNameHandler constructor.
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param ExecuteChangeUserName $command
     * @throws \Exception
     */
    public function handle(ExecuteChangeUserName $command): void
    {
        $user = $this->repository->userOfId(UserId::fromString($command->id));
        $user->changeName(Name::fromString($command->firstName, $command->lastName));

        $this->repository->add($user);
    }
}
