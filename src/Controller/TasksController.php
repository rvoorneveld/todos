<?php

namespace App\Controller;

use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\{
    HttpFoundation\Request,
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
     * @Route("/", methods="GET")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('tasks/overview.html.twig', [
            'tasks' => $this->taskRepository->findAll(),
        ]);
    }

    /**
     * @Route("/", methods="POST")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $this->taskRepository->create(
            $request->get('title')
        );

        return $this->redirect('/');
    }

    /**
     * @Route("/task/{id}", methods="PATCH")
     * @param Request $request
     * @return Response
     */
    public function update(Request $request): Response
    {
        $this->taskRepository->update($request->get('id'), [
            'title' => $request->get('title'),
        ]);

        return $this->redirect('/');
    }

}
