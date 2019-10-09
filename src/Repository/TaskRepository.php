<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

class TaskRepository extends ServiceEntityRepository
{

    protected $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Task::class);

        $this->entityManager = $entityManager;
    }

    public function create(string $title): Task
    {
        $this->entityManager->persist(
            ($task = new Task)->setTitle($title)
        );

        $this->entityManager->flush();

        return $task;
    }

    public function update(int $id, array $data)
    {
        $task = $this->entityManager->getRepository(Task::class)->find($id);

        array_walk($data, static function($value, $key) use($task) {
            $method = ucfirst($key);
            $task->{"set{$method}"}($value);
        });

        $this->entityManager->flush();

        return $task;
    }

}
