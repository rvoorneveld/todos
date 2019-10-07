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

}
