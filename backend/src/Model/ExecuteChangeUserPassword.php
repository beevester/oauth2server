<?php


namespace App\Model;


class ExecuteChangeUserPassword
{
    public string $id;
    public string $currentPassword;
    public string $newPassword;

    /**
     * ChangePasswordCommand constructor.
     * @param string $id
     * @param string $currentPassword
     * @param string $newPassword
     */
    public function __construct(string $id, string $currentPassword, string $newPassword)
    {
        $this->id = $id;
        $this->currentPassword = $currentPassword;
        $this->newPassword = $newPassword;
    }
}
