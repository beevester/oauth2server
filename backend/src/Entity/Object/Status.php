<?php


namespace App\Entity\Object;


final class Status
{
    public const WAIT = 'wait';
    public const ACTIVE = 'active';
    /**
     * @var string
     */
    private $type;

    /**
     * Status constructor.
     * @param string $type
     */
    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public static function wait(): self
    {
        $self = new self(self::WAIT);
        return $self;
    }

    public static function active(): self
    {
        $self = new self(self::ACTIVE);
        return $self;
    }

    public function isWait(): bool
    {
        return $this->type === self::WAIT;
    }

    public function isActive(): bool
    {
        return $this->type === self::ACTIVE;
    }


}
