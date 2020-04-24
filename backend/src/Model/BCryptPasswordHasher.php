<?php

namespace App\Model;

use App\Interfaces\PasswordEncodedInterface;
use InvalidArgumentException as InvalidArgumentExceptionAlias;

class BCryptPasswordHasher implements PasswordEncodedInterface
{
    private int $cost;

    /**
     * BCryptPasswordHasher constructor.
     * @param int $cost
     */
    public function __construct(int $cost = 12)
    {
        $this->cost = $cost;
    }

    /**
     * @param string $password
     * @return string
     * @throws \Exception
     */
    public function hash(string $password): string
    {
        if (strlen($password) < 6) {
            throw new InvalidArgumentExceptionAlias(
                \sprintf(
                    'Expected a password to contain at least %2$s characters. Got: %s',
                    $password,
                    6
                )
            );
        }

        $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => $this->cost]);

        if ($hash === false) {
            throw new \Exception('Unable to generate hash.');
        }

        return $hash;
    }

    /**
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public function validate(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}
