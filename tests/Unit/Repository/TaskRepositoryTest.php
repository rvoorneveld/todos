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

    public function testTaskCanBeUpdated(): void
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

}
