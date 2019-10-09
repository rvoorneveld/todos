<?php

namespace App\Tests\Unit\Repository;

use App\Entity\Task;
use App\Tests\Traits\InteractsWithDatabase;
use App\Tests\Unit\KernelTestCase;

class TaskRepositoryTest extends KernelTestCase
{

    use InteractsWithDatabase;

    public function testTaskCanBeCreated(): void
    {
        $task = ($this->getEntityManager()->getRepository(Task::class))->create(
            $title = $this->faker->sentence
        );

        $this->assertSame($title, $task->getTitle());
    }

    public function testTaskTitleCanBeUpdated(): void
    {
        $taskId = (($taskRepository = $this->getEntityManager()->getRepository(Task::class))->create(
            $title = $this->faker->sentence
        ))->getId();

        $updatedTask = $taskRepository->update($taskId, [
            'title' => $updatedTitle = $this->faker->unique()->sentence,
        ]);

        $this->assertNotSame($title, $updatedTaskTitle = $updatedTask->getTitle());
        $this->assertSame($updatedTitle, $updatedTaskTitle);
    }

    public function testTaskCanBeMarkedAsComplete(): void
    {
        $taskId = ($task = ($taskRepository = $this->getEntityManager()->getRepository(Task::class))->create(
            $title = $this->faker->sentence
        ))->getId();

        $this->assertNull($task->getCompleted());

        $updatedTask = $taskRepository->update($taskId, [
            'completed' => $dateTime = new \DateTime,
        ]);

        $this->assertSame($dateTime, $updatedTask->getCompleted());
    }

    public function testTaskCanBeMarkedAsIncomplete(): void
    {
        $taskId = (($taskRepository = $this->getEntityManager()->getRepository(Task::class))->create(
            $title = $this->faker->sentence
        ))->getId();

        $task = $taskRepository->update($taskId, [
            'completed' => null,
        ]);

        $this->assertNull($task->getCompleted());
    }

}
