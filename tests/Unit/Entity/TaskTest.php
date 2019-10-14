<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Task;
use App\Tests\Traits\InteractsWithDatabase;
use App\Tests\Unit\KernelTestCase;

class TaskTest extends KernelTestCase
{

    use InteractsWithDatabase;

    public function testAttributesCanBeRetrieved(): void
    {
        $task = ($this->getEntityManager()->getRepository(Task::class))->create(
            $title = $this->faker->sentence
        );

        $this->assertSame(1, $task->getId());
        $this->assertSame($title, $task->getTitle());
        $this->assertNull($task->getCompleted());
    }

}
