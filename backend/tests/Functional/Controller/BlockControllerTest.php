<?php

namespace App\Tests\Functional\Controller;

use App\Entity\Block;
use App\Entity\Block\BlockType;
use App\Tests\Support\JsonRequestTrait;
use App\Tests\Support\KernelUtilsTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BlockControllerTest extends WebTestCase
{
    use KernelUtilsTrait;
    use JsonRequestTrait;

    public function testList()
    {
        $client = static::createClient();

        $this->purgeTables(static::getContainer(),  [Block::class]);
        $this->createBlock(BlockType::Header);

        $client->request('GET', '/api/v1/block/');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
        $this->assertCount(1, json_decode($client->getResponse()->getContent()));
    }

    private function createBlock(BlockType $type): Block
    {
        $fixtureManager = $this->getFixtureManager(static::getContainer());

        return $fixtureManager->createBlock(['type' => $type]);
    }
}
