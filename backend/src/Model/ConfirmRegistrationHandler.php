<?php


namespace App\Model;


use App\Entity\Object\DateTime;
use App\Entity\Object\Email;
use App\Interfaces\UserRepositoryInterface;

class ConfirmRegistrationHandler
{
    /**
     * @var UserRepositoryInterface
     */
    private $repository;

    /**
     * ConfirmRegistrationHandler constructor.
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param ExecuteRegisterConfirmation $data
     * @throws \Exception
     */
    public function handle(ExecuteRegisterConfirmation $data): void
    {
        $user = $this->repository->userOfEmail(Email::fromString($data->email));
        $user->confirmRegistrationByEmail($data->token, DateTime::now());

        $this->repository->add($user);
    }
}
