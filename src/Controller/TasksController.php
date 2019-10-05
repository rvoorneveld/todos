<?php

namespace App\Controller;

use Symfony\Component\{
    HttpFoundation\Response,
    Routing\Annotation\Route
};

class TasksController
{

    /**
     * @Route("/")
     * @return Response
     */
    public function index(): Response
    {
        return new Response('Show all tasks');
    }

}
