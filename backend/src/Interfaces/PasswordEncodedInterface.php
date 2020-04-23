<?php


namespace App\Interfaces;


interface PasswordEncodedInterface
{
    /**
     * @param string $password
     * @return string
     */
    public function hash(string $password): string;

    /**
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public function validate(string $password, string $hash): bool;
}
