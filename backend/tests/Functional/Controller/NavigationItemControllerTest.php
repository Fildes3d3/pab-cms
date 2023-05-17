<?php

namespace App\Tests\Functional\Controller;

use App\Entity\Block;
use App\Entity\Navigation\NavigationItemType;
use App\Entity\NavigationItem;
use App\Tests\Support\JsonRequestTrait;
use App\Tests\Support\KernelUtilsTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NavigationItemControllerTest extends WebTestCase
{
    use KernelUtilsTrait;
    use JsonRequestTrait;

    public function testList()
    {
        $client = static::createClient();

        $this->purgeTables(static::getContainer(),  [NavigationItem::class]);
        $this->createNavigationItem(NavigationItemType::InternalLink);

        $client->request('GET', '/api/v1/navigation/items');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
        $this->assertCount(1, json_decode($client->getResponse()->getContent()));
    }

    private function createNavigationItem(NavigationItemType $type): NavigationItem
    {
        $fixtureManager = $this->getFixtureManager(static::getContainer());

        return $fixtureManager->createNavigationItem(['type' => $type]);
    }
}
