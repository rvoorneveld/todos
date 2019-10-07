<?php

namespace App\Tests\Traits;

use Doctrine\ORM\EntityManager;

trait InteractsWithDatabase
{

    protected $entityManager;

    public function getEntityManager(): EntityManager
    {
        return $this->entityManager ?? $this->entityManager = (self::bootKernel())->getContainer()->get('doctrine')->getManager();
    }

}
