<?php

namespace App\Model;

use App\Entity\Object\Email;
use App\Entity\Object\UserId;
use App\Interfaces\CheckEmailInterface;
use App\Interfaces\UserRepositoryInterface;

class ChangeUserEmailHandler
{
    private UserRepositoryInterface $repository;
    private CheckEmailInterface $checker;

    /**
     * ChangeEmailHandler constructor.
     * @param UserRepositoryInterface $repository
     * @param CheckEmailInterface $checker
     */
    public function __construct(
        UserRepositoryInterface $repository,
        CheckEmailInterface $checker
    ) {
        $this->repository = $repository;
        $this->checker = $checker;
    }

    /**
     * @param ExecuteChangeEmail $command
     * @throws \Exception
     */
    public function handle(ExecuteChangeEmail $command): void
    {
        $user = $this->repository->userOfId(UserId::fromString($command->id));
        $user->changeEmail(Email::fromString($command->email), $this->checker);

        $this->repository->add($user);
    }
}
