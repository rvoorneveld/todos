<?php

namespace App\Tests\Integration\TasksController;

use App\Entity\Task;
use App\Tests\Integration\WebTestCase;
use App\Tests\Traits\InteractsWithDatabase;

class IndexTest extends WebTestCase
{

    use InteractsWithDatabase;

    protected function createTask(string $title): void
    {
        ($em = $this->getEntityManager())->persist(
            (new Task)->setTitle($title)
        );
        $em->flush();
    }

    public function testIndexCountsNumberOfTasks(): void
    {
        $crawler = ($client = static::createClient())->request('GET', '/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertStringContainsString('Todos (0)', $crawler->text());

        $this->createTask('foo');

        $crawler = $client->request('GET', '/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertStringContainsString('Todos (1)', $crawler->text());
    }

}
