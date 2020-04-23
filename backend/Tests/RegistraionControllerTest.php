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

    /**
     * @test
     * @group e2e
     */
    public function userRegistrationShouldBeSuccessful(): void
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
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'email' => 'test-john@app.test',
                    'password' => 'password',
                ]
            )
        );

        self::assertSame(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
        self::assertJson($this->client->getResponse()->getContent());
    }

    /**
     * @test
     * @group e2e
     */
    public function whenTryingToRegisterAgainUserShouldReceiveAnError(): void
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
                    'first_name' => 'Tom',
                    'last_name' => 'Bent',
                    'email' => 'exesting-user@app.test',
                    'password' => 'password',
                ]
            )
        );

        $this->client->request(
            'POST',
            self::URI,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(
                [
                    'id' => Uuid::uuid4()->toString(),
                    'first_name' => 'Tom',
                    'last_name' => 'Bent',
                    'email' => 'exesting-user@app.test',
                    'password' => 'password',
                ]
            )
        );

        self::assertSame(Response::HTTP_BAD_REQUEST, $this->client->getResponse()->getStatusCode());
        self::assertJson($this->client->getResponse()->getContent());
    }

    /**
     * @group e2e
     */
    public function ifTheUserEntersInvalidDataHeShouldReceiveAnErrorMessage(): void
    {
        $this->client->request(
            'POST',
            self::URI,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(
                [
                    'first_name' => '',
                    'last_name' => '',
                    'email' => 'not-email',
                    'password' => 'short',
                ]
            )
        );

        self::assertEquals(Response::HTTP_BAD_REQUEST, $this->client->getResponse()->getStatusCode());
        self::assertJson($content = $this->client->getResponse()->getContent());
    }
}
