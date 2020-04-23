<?php


namespace App\Model;

use App\Query\GetProfileById;
use App\Views\ProfileDetails;
use Doctrine\DBAL\Connection;

class GetProfileHandler
{
    /**
     * @var DBConnection
     */
    private $connection;

    /**
     * GetProfileHandler constructor.
     * @param DBConnection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param GetProfileById $query
     * @return ProfileDetails
     * @throws \Exception
     */
    public function handle(GetProfileById $query): ProfileDetails
    {
        $parameters = [
            ':id' => $query->id
        ];

        $stmt = $this->connection->prepare(
            'SELECT id, name_first as first_name, name_last as last_name, email, password, status_type as status, created_on 
                        FROM users 
                        WHERE id=:id', 'assoc', true, $parameters
        );

        $stmt->execute();

        $data = $stmt->fetch(FetchNode::ASSOCIATATIVE);

        if (!$data) {
            throw new \Exception("Profile doesnt exist");
        }

        return new ProfileDetails(
            $data['id'],
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['status'],
            $data['password'],
            $data['created_on'],
        );
    }


}
