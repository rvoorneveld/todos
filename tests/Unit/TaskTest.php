<?php

namespace App\Tests\Unit;

use App\Entity\Task;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{

    protected $stub;

    public function setUp(): void
    {
        parent::setUp();

        $this->stub = new Task;
    }

    public function testTitleCanBeRetrieved(): void
    {
        $this->assertSame($expected = 'foo', $this->stub->setTitle($expected)->getTitle());
    }

}
