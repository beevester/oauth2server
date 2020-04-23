<?php


namespace App\Model;

use App\Entity\Object\Email;
use App\Entity\Object\Name;
use App\Entity\Object\UserId;
use App\Entity\User;
use App\Interfaces\CheckEmailInterface;
use App\Interfaces\ConfirmTokenInterface;
use App\Interfaces\PasswordEncodedInterface;
use App\Interfaces\UserRepositoryInterface;

class RegisterUserHandler
{
    /**
     * @var UserRepositoryInterface
     */
    private $repository;
    /**
     * @var CheckEmailInterface
     */
    private $checkEmail;
    /**
     * @var PasswordEncodedInterface
     */
    private $passwordEncoded;
    /**
     * @var ConfirmTokenInterface
     */
    private $confirmToken;

    /**
     * RegisterUserHandler constructor.
     * @param UserRepositoryInterface $repository
     * @param CheckEmailInterface $checkEmail
     * @param PasswordEncodedInterface $passwordEncoded
     * @param ConfirmTokenInterface $confirmToken
     */
    public function __construct(
        UserRepositoryInterface $repository,
        CheckEmailInterface $checkEmail,
        PasswordEncodedInterface $passwordEncoded,
        ConfirmTokenInterface $confirmToken
    )
    {
        $this->repository = $repository;
        $this->checkEmail = $checkEmail;
        $this->passwordEncoded = $passwordEncoded;
        $this->confirmToken = $confirmToken;
    }

    public function handle(ExecuteRegisterUser $data)
    {
        $user = User::registerByEmail(
            UserId::fromString($data->id),
            Name::fromString($data->firstName, $data->lastName),
            Email::fromString($data->email),
            $this->passwordEncoded->hash($data->password),
            $this->confirmToken->generate(),
            $this->checkEmail
,        );

        $this->repository->add($user);
    }
}
