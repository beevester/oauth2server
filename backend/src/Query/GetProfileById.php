<?php


namespace App\Query;


final class GetProfileById
{
    /**
     * @var string
     */
    public $id;

    /**
     * GetProfileById constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }
}
