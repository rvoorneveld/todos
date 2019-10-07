<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class TaskRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function create(string $title): Task
    {
        ($entityManager = $this->getEntityManager())->persist(
            ($task = new Task)->setTitle($title)
        );

        $entityManager->flush();

        return $task;
    }

}
