<?php

namespace App\Model;

use App\Entity\Object\Name;
use App\Entity\Object\UserId;
use App\Entity\User;
use App\Interfaces\CheckerIdInterface;
use App\Interfaces\PasswordEncodedInterface;
use App\Interfaces\UserRepositoryInterface;

class CreateUserHandler
{
    private UserRepositoryInterface $repository;
    private PasswordEncodedInterface $hasher;
    private CheckerIdInterface $checkerById;

    /**
     * CreateUserHandler constructor.
     * @param UserRepositoryInterface $repository
     * @param CheckerIdInterface $checkerById
     * @param PasswordEncodedInterface $hasher
     */
    public function __construct(
        UserRepositoryInterface $repository,
        CheckerIdInterface $checkerById,
        PasswordEncodedInterface $hasher
    ) {
        $this->repository = $repository;
        $this->hasher = $hasher;
        $this->checkerById = $checkerById;
    }

    /**
     * @param ExecuteCreateUser $command
     * @return UserId
     * @throws \Exception
     */
    public function handle(ExecuteCreateUser $command): UserId
    {
        var_dump((string)$command->password);
        $user = User::create(
            $userId = $this->repository->nextIdentity(),
            Name::fromString($command->firstName, $command->lastName),
            $this->hasher->hash($command->password),
            $this->checkerById
        );

        $this->repository->add($user);

        return $userId;
    }
}
