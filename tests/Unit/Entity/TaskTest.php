<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Task;
use App\Tests\Traits\InteractsWithDatabase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TaskTest extends KernelTestCase
{

    use InteractsWithDatabase;

    public function testAttributesCanBeRetrieved(): void
    {
        $task = ($this->getEntityManager()->getRepository(Task::class))->create($title = 'foo');

        $this->assertSame(1, $task->getId());
        $this->assertSame($title, $task->getTitle());
    }

}
