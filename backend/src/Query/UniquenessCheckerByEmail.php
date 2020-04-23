<?php

namespace App\Query;

use App\Entity\Object\Email;
use Doctrine\DBAL\Connection;

class UniquenessCheckerByEmail
{
    private Connection $connection;

    /**
     * UserUniquenessCheckerByEmail constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param Email $email
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     */
    public function isUnique(Email $email): bool
    {
        $stmt = $this->connection->prepare('SELECT COUNT(id) FROM users WHERE email=:email');
        $stmt->execute([':email' => (string)$email]);

        $data = $stmt->fetch();

        return $data['count'] === 0;
    }
}
