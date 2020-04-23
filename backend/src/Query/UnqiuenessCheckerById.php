<?php


namespace App\Query;


use App\Entity\Object\UserId;
use Doctrine\DBAL\Connection;

class UnqiuenessCheckerById
{
    private Connection $connection;

    /**
     * UserUniquenessCheckerById constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param UserId $userId
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     */
    public function isUnique(UserId $userId): bool
    {
        $stmt = $this->connection->prepare('SELECT COUNT(id) FROM users WHERE id=:id');
        $stmt->execute([':id' => (string)$userId]);

        $data = $stmt->fetch();

        return $data['count'] === 0;
    }
}
