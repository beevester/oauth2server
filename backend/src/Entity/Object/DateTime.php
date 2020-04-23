<?php


namespace App\Entity\Object;

class DateTime
{
    public const FORMAT = 'Y-m-d\TH:i:s.uP';
    private \DateTimeImmutable $dateTime;


    /**
     * @return DateTime
     */
    public static function now(): self
    {
        return self::create();
    }


    /**
     * @param string $dateTime
     * @return DateTime
     */
    public static function fromString(string $dateTime): self
    {
        return self::create($dateTime);
    }

    /**
     * @param string $dateTime
     * @return DateTime|\Exception
     * @throws \Exception
     */
    private static function create(string $dateTime = '')
    {
        $self = new self();

        try {
            $self->dateTime = new \DateTimeImmutable($dateTime);
        } catch (\Exception $e) {
             throw new \Exception($e);
        }

        return $self;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->dateTime->format(self::FORMAT);
    }

    /**
     * @return \DateTimeImmutable
     */
    public function toNative(): \DateTimeImmutable
    {
        return $this->dateTime;
    }
}
