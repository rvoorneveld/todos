<?php

namespace App\Tests\Integration\TasksController;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndexTest extends WebTestCase
{

    public function testIndexShowsAllTasks(): void
    {
        $crawler = ($client = static::createClient())->request('GET', '/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame('Show all tasks', $crawler->text());
    }

}
