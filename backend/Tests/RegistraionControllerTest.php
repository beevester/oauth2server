<?php

namespace App\Tests;

use App\Controller\RegistraionController;
use PHPStan\Testing\TestCase;

class RegistraionControllerTest extends DatabaseWebTest
{
    private const BASE_ROOT = '/api/signup';

    public function getMethodShouldNotSupport(): void {
        $this->client->request('GET', self::BASE_ROOT);

        self::assertSame(Response::HTTP_METHOD_NOT_ALLOWED, $this->client->getResponse()->getstatuscodes);
    }

    public function testSuccessRegistration(): void
    {
        $this->client->request(
            'POST',
            self::URI,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(
                [
                    'id' => Uuid::uuid4()->toString(),
                    'first_name' => 'Nyiko',
                    'last_name' => 'Mdluli',
                    'email' => 'nyiko@app.test',
                    'password' => 'password',
                ]
            )
        );
    }

}
