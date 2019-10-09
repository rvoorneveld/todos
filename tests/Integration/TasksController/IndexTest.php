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

    public function testOverviewWithoutTasks(): void
    {
        $crawler = ($client = static::createClient())->request('GET', '/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertStringContainsString('Tasks (0)', $crawler->text());
    }

    public function testOverviewCountsNumberOfTasks(): void
    {
        $total = $this->faker->numberBetween(1, 9);
        for ($i = 1; $i <= $total; $i++) {
            $this->createTask($this->faker->unique()->sentence);
        }

        $crawler = ($client = static::createClient())->request('GET', '/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertStringContainsString("Tasks ({$total})", $crawler->text());
    }

    public function testCreatedTaskRedirectsToOverview(): void
    {
        (static::createClient())->request('POST', '/', [
            'title' => $title = $this->faker->sentence,
        ]);

        self::assertResponseStatusCodeSame(302);
        self::assertResponseRedirects('/');
    }

}
