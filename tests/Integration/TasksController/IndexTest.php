<?php

namespace App\Tests\Integration\TasksController;

use App\Entity\Task;
use App\Tests\Integration\WebTestCase;
use App\Tests\Traits\InteractsWithDatabase;

class IndexTest extends WebTestCase
{

    use InteractsWithDatabase;

    protected function addTask(?string $title = null): Task
    {
        ($em = $this->getEntityManager())->persist(
            $task = (new Task)->setTitle($title ?? $this->faker->sentence)
        );
        $em->flush();

        return $task;
    }

    public function testOverviewWithoutTasks(): void
    {
        $crawler = ($client = static::createClient())->request('GET', '/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertStringContainsString('Tasks (0)', $crawler->text());
    }

    public function testOverviewShowsTasks(): void
    {
        $total = $this->faker->numberBetween(1, 9);
        $titles = [];
        for ($i = 1; $i <= $total; $i++) {
            $this->addTask($titles[] = $this->faker->unique()->sentence);
        }

        $crawler = ($client = static::createClient())->request('GET', '/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertStringContainsString("Tasks ({$total})", $crawler->text());

        foreach ($titles as $title) {
            $this->assertContains($title, $crawler->filter('.test-tasks .test-tasks__title')->extract('value'));
        }
    }

    public function testTaskCanBeCreated(): void
    {
        (static::createClient())->request('POST', '/', [
            'title' => $title = $this->faker->sentence,
        ]);

        self::assertResponseStatusCodeSame(302);
        self::assertResponseRedirects('/');
    }

    public function testTaskTitleCanBeUpdated(): void
    {
        $taskId = ($this->addTask())->getId();

        (static::createClient())->request('PATCH', "/task/{$taskId}", [
            'title' => $title = $this->faker->unique()->sentence,
        ]);

        $this->assertSame($title, ($this->getEntityManager()->find(Task::class, $taskId))->getTitle());
    }

    public function testTaskCompletedCanBeUpdated(): void
    {
        $taskId = ($task = $this->addTask())->getId();

        $this->assertNull($task->getCompleted());

        (static::createClient())->request('PATCH', "/task/{$taskId}", [
            'title' => $this->faker->sentence,
            'completed' => new \DateTime,
        ]);

        $this->assertNotNull(($this->getEntityManager()->find(Task::class, $taskId))->getCompleted());
    }

}
