<?php

namespace App\Controller;

use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\{
    HttpFoundation\Response,
    Routing\Annotation\Route
};

class TasksController extends AbstractController
{

    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @Route("/")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('tasks/overview.html.twig', [
            'tasks' => $this->taskRepository->findAll(),
        ]);
    }

}
