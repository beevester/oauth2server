<?php

namespace App\Tests;

use App\Controller\ProfileController;
use App\Tests\OAuthFixture;
use PHPUnit\Framework\TestCase;

class ProfileControllerTest extends TestCase
{

    private const URI = '/api/profile';

    /**
     * @test
     * @group e2e
     */
    public function getMethodShouldNotSupported(): void
    {
        $this->client->request('GET', self::URI);

        self::assertEquals(Response::HTTP_UNAUTHORIZED, $this->client->getResponse()->getStatusCode());
    }

    /**
     * @test
     * @group e2e
     */
    public function authorizedUserShouldHaveAccessToProfileData(): void
    {
        $this->client->setServerParameters(OAuthFixture::userCredentials());
        $this->client->request('GET', self::URI);

        self::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        self::assertJson($this->client->getResponse()->getContent());
    }
}
