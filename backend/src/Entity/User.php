<?php


namespace App\Entity;


use App\Entity\Object\ConfirmationToken;
use App\Entity\Object\DateTime;
use App\Entity\Object\Email;
use App\Entity\Object\Name;
use App\Entity\Object\Status;
use App\Entity\Object\UserId;
use App\Events\AggregateRoot;
use App\Events\UserEmailWasChanged;
use App\Events\UserNameWasChanged;
use App\Events\UserPasswordWasChanged;
use App\Events\UserRegisteredByEmail;
use App\Interfaces\CheckEmailInterface;
use App\Interfaces\CheckerIdInterface;
use App\Interfaces\PasswordEncodedInterface;
use Exception;

class User extends AggregateRoot
{
    /**
     * @var UserId
     */
    protected $id;
    /**
     * @var Name
     */
    protected $name;
    /**
     * @var string
     */
    protected $password;
    /**
     * @var Status
     */
    protected $status;
    /**
     * @var DateTime
     */
    public $createdOn;

    protected ?ConfirmationToken $confirmToken = null;
    /**
     * @var Email
     */
    protected $email;
    /**
     * @var ?DateTime
     */
    protected $changedOn = null;

    /**
     * @return null
     */
    public function getConfirmToken()
    {
        return $this->confirmToken;
    }

    /**
     * @return mixed
     */
    public function getChangedOn()
    {
        return $this->changedOn;
    }

    /**
     * User constructor.
     * @param UserId $id
     * @param Name $name
     * @param string $password
     * @param Status $status
     */
    public function __construct(
        UserId $id,
        Name $name,
        string $password,
        Status $status
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->password = $password;
        $this->status = $status;
        $this->createdOn = DateTime::now();
    }

    /**
     * @param UserId $id
     * @param Name $name
     * @param string $password
     * @param CheckerIdInterface $checkerId
     * @return User
     * @throws Exception
     */
    public static function create(
        UserId $id,
        Name $name,
        string $password,
        CheckerIdInterface $checkerId
    ): User {
        if (!$checkerId->isUnique($id)) {
            throw new Exception('User already created.');
        }

        $user = new self(
            $id,
            $name,
            $password,
            Status::active()
        );

        $user->recordEvent(new UserWasCreated(
                $id,
                $name
            )
        );

        return $user;
    }

    /**
     * @param UserId $id
     * @param Name $name
     * @param Email $email
     * @param string $password
     * @param ConfirmationToken $token
     * @param CheckEmailInterface $checkEmail
     * @return User
     * @throws Exception
     */
    public function registerByEmail(
        UserId $id,
        Name $name,
        Email $email,
        string $password,
        ConfirmationToken $token,
        CheckEmailInterface $checkEmail
    ): User {
        if (!$checkEmail->isUnique($email)) {
            throw new Exception('User already registered, Please try logging in');
        }

        $user = new self(
            $id,
            $name,
            $password,
            Status::wait()
        );

        $this->email = $email;
        $this->confirmToken = $token;

        $user->recordEvent(
            new UserRegisteredByEmail(
                $id,
                $email,
                $name,
                $token
            )
        );

        return $user;
    }

    /**
     * @param string $token
     * @param DateTime $expiresDate
     * @throws Exception
     */
    public function confirmRegistrationByEmail(string $token, DateTime $expiresDate): void
    {
        if ($this->isActive()) {
            throw new Exception('Email is not active');
        }

        if ($this->confirmToken === null) {
            throw new Exception('There is no email registered with this User');
        }

        $this->confirmToken->validate($token, $expiresDate);
        $this->status = Status::ACTIVE;
        $this->confirmToken = null;
    }

    /**
     * @param Name $name
     */
    public function changeName(Name $name): void
    {
        $this->name = $name;

        $this->recordEvent(
            new UserNameWasChanged(
                $this->id,
                $this->name
            )
        );
    }

    /**
     * @param Email $newEmail
     * @param CheckEmailInterface $checkEmail
     * @throws Exception
     */
    public function changeEmail(Email $newEmail, CheckEmailInterface $checkEmail): void
    {
        if (!$checkEmail->isUnique($newEmail)) {
            throw new Exception('Email already exist');
        }

        $this->email = $newEmail;

        $this->recordEvent(
            new UserEmailWasChanged(
                $this->id,
                $this->email
            )
        );
    }

    /**
     * @param string $currentPasswork
     * @param string $newPassword
     * @param PasswordEncodedInterface $passwordEncoded
     * @throws Exception
     */
    public function changePassword(string $currentPassword, string $newPassword, PasswordEncodedInterface $passwordEncoded): void
    {
        if (!$this->password) {
            throw  new Exception('There is no password setup for the current user');
        }
        if (!$passwordEncoded->validate($currentPassword, $this->password)) {
            throw new Exception('Incorrect current password.');
        }

        $this->password = $passwordEncoded->hash($newPassword);

        $this->recordEvent(
            new UserPasswordWasChanged(
                $this->id
            )
        );
    }

    /**
     * @return bool
     */
    public function isWait(): bool
    {
        return $this->status->isWait();
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->status->isActive();
    }

    /**
     * @return UserId
     */
    public function getId(): UserId
    {
        return $this->id;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return DateTime
     */
    public function getCreatedOn(): DateTime
    {
        return $this->createdOn;
    }

    public function clearRecordedEvent(): void
    {
        // TODO: Implement clearRecordedEvent() method.
    }
}
