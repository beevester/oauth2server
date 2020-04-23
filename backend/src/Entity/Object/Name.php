<?php


namespace App\Entity\Object;


use Exception;

final class Name
{
    private string $first;
    private ?string $last;

    /**
     * Name constructor.
     * @param string $first
     * @param string|null $last
     * @throws Exception
     */
    public function __construct(string $first, ?string $last)
    {
        $this->setFirst($first);
        $this->setLast($last);
    }

    /**
     * @param string $first
     * @throws Exception
     */
    private function setFirst(string $first): void
    {
        if  (!$first) {
            throw new Exception('First name not found.');
        }
        $this->first = trim($first);
    }

    /**
     * @param string|null $last
     */
    private function setLast(?string $last): void
    {
        $this->last = $last ? trim($last) : $last;
    }

    /**
     * @param string $first
     * @param string|null $last
     * @return Name
     * @throws Exception
     */
    public static function fromString(string $first, ?string $last): self
    {
        $self = new self($first, $last);
        return $self;
    }

    /**
     * @return string
     */
    public function first(): string
    {
        return $this->first;
    }

    /**
     * @return string|null
     */
    public function last(): ?string
    {
        return $this->last;
    }

    /**
     * @return string
     */
    public function full(): string
    {
        if ($this->last)
        {
            return $this->first . ' ' . $this->last;
        }

        return $this->first;
    }
}
