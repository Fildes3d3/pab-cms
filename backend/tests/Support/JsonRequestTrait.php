<?php

namespace App\Tests\Support;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\DomCrawler\Crawler;

trait JsonRequestTrait
{
    protected function jsonRequest(KernelBrowser $client, array $headers, string $method, string $uri, array $data = []): Crawler
    {
        return $client->request(
            $method,
            $uri,
            [],
            [],
            $headers,
            json_encode($data)
        );
    }
}
