<?php


namespace App\Security\Events;

use App\Entity\Object\Email;
use App\Interfaces\PasswordEncodedInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Security\ProfileById;
use Trikoder\Bundle\OAuth2Bundle\Event\UserResolveEvent;
use Trikoder\Bundle\OAuth2Bundle\OAuth2Events;

class UserResolver
{
    private UserRepositoryInterface $repository;
    private PasswordEncodedInterface $hasher;

    /**
     * UserResolver constructor.
     * @param UserRepositoryInterface $repository
     * @param PasswordEncodedInterface $hasher
     */
    public function __construct(UserRepositoryInterface $repository, PasswordEncodedInterface $hasher)
    {
        $this->repository = $repository;
        $this->hasher = $hasher;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            OAuth2Events::USER_RESOLVE => 'onUserResolve',
        ];
    }

    /**
     * @param UserResolveEvent $event
     * @throws \Exception
     */
    public function onUserResolve(UserResolveEvent $event): void
    {
        $user = $this->repository->userOfEmail(Email::fromString($event->getUsername()));

        if ($user->getStatus()->isWait()) {
            return;
        }

        if (!$password = $user->getPassword()) {
            return;
        }

        if (!$this->hasher->validate($event->getPassword(), $password)) {
            return;
        }

        $event->setUser(
            new ProfileById($user->getId(), $password, $user->getStatus())
        );
    }
}
