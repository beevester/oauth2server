<?php

namespace App\Model;

use App\Entity\Object\ConfirmationToken;
use App\Entity\Object\DateTime;
use App\Interfaces\ConfirmTokenInterface;
use DateInterval;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;

class RandConfirmTokenizer implements ConfirmTokenInterface
{
    private string $interval;

    /**
     * RandConfirmTokenizer constructor.
     * @param string $interval
     */
    public function __construct(string $interval)
    {
        $this->interval = $interval;
    }

    /**
     * @return ConfirmationToken
     * @throws \Exception
     */
    public function generate(): ConfirmationToken
    {
        return new ConfirmationToken(
            Uuid::uuid4()->toString(),
            DateTime::fromString(
                (new DateTimeImmutable())->add(new  DateInterval($this->interval))->format(DateTime::FORMAT)
            )
        );
    }
}
