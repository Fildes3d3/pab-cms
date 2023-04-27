<?php

namespace App\Tests\Functional\Controller;

use App\Entity\User;
use App\Tests\Support\JsonRequestTrait;
use App\Tests\Support\KernelUtilsTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    use KernelUtilsTrait;
    use JsonRequestTrait;

    public function testLoginSuccess()
    {
        $client = static::createClient();
        $client->loginUser($this->createUser());

        $client->request('GET', '/admin');

        $this->assertResponseIsSuccessful();
    }

    private function createUser(): User
    {
        $fixtureManager = $this->getFixtureManager(static::getContainer());

        return $fixtureManager->createUser([
            'password' => 'password'
        ]);
    }
}
