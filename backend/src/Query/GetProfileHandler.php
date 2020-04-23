<?php


namespace App\Query;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\FetchMode;

class GetProfileHandler
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param GetProfileById $query
     * @return ProfileView
     * @throws \Doctrine\DBAL\DBALException
     */
    public function handle(GetProfileById $query): ProfileView
    {
        $stmt = $this->connection->prepare(
            'SELECT id, name_first as first_name, name_last as last_name, email, password, status_type as status, created_on 
                        FROM users 
                        WHERE id=:id'
        );
        $stmt->execute([':id' => $query->id]);

        $data = $stmt->fetch(FetchMode::ASSOCIATIVE);

        if (!$data) {
            throw new \Exception();
        }

        return new ProfileView(
            $data['id'],
            $data['first_name'],
            $data['created_on'],
            $data['password'],
            $data['status'],
            $data['last_name'],
            $data['email'],
            );
    }
}
