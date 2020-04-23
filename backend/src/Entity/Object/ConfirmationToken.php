<?php

declare(strict_types=1);

namespace App\Entity\Object;

use Exception as ExceptionAlias;

final class ConfirmationToken
{
    private const MIN_LENGTH = 6;
    private ?string $value;
    private ?DateTime $expires;

    /**
     * ConfirmationToken constructor.
     * @param string $token
     * @param DateTime $expires
     * @throws \Exception
     */
    public function __construct(string $token, DateTime $expires)
    {
        $this->setToken($token);
        $this->setExpires($expires);
    }

    /**
     * @param string $token
     * @param DateTime $date
     * @return bool
     * @throws \Exception
     */
    public function validate(string $token, DateTime $date): bool
    {
        if (!$this->isEqualTo($token)) {
            throw new ExceptionAlias('Confirmation token is invalid.');
        }
        if ($this->isExpiredTo($date)) {
            throw new ExceptionAlias('Confirmation token is invalid.');
        }

        return true;
    }

    /**
     * @return string|null
     */
    public function token(): ?string
    {
        return $this->value;
    }

    /**
     * @return DateTime|null
     */
    public function expiresDate(): ?DateTime
    {
        return $this->expires;
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->token);
    }

    /**
     * @param string $token
     * @return bool
     */
    private function isEqualTo(string $token): bool
    {
        return $this->value === $token;
    }

    /**
     * @param DateTime $date
     * @return bool
     */
    private function isExpiredTo(DateTime $date): bool
    {
        return $this->expires <= $date;
    }

    /**
     * @param string $token
     * @throws \Exception
     */
    private function setToken(string $token): void
    {
        if (strlen($token) < self::MIN_LENGTH) {
            throw new ExceptionAlias(
                \sprintf(
                    'Expected a token to contain at least %2$s characters. Got: %s',
                    $token,
                    self::MIN_LENGTH
                )
            );
        }

        $this->value = $token;
    }

    /**
     * @param DateTime $expires
     */
    private function setExpires(DateTime $expires): void
    {
        $this->expires = $expires;
    }
}
