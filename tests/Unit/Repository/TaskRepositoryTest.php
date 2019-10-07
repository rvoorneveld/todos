<?php

namespace App\Tests\Unit\Repository;

use App\Entity\Task;
use App\Tests\Traits\InteractsWithDatabase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TaskRepositoryTest extends KernelTestCase
{

    use InteractsWithDatabase;

    public function testTaskCanBeCreated(): void
    {
        $task = ($this->getEntityManager()->getRepository(Task::class))->create($expected = 'foo');

        $this->assertSame($expected, $task->getTitle());
    }

}
