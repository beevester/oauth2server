<?php


namespace App\Interfaces;


interface AggregateId
{
    /**
     * @param string $id
     * @return AggregateId
     */
    public static function fromString(string $id): self;

    /**
     * @return mixed
     */
    public function __toString();

    /**
     * @param AggregateId $other
     * @return bool
     */
    public function equals(AggregateId $other): bool;
}
