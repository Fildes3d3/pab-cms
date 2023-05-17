<?php

namespace App\Controller\API;

use App\Controller\RESTController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('page')]
class PageController extends RESTController
{
    #[Route('/', name: 'page_list', methods: ['GET'])]
    public function list(): Response
    {
        return $this->json([]);
    }

     #[Route('/{id}', name: 'page_self', methods: ['GET'])]
    public function self()
    {
    }

     #[Route('/', name: 'page_add', methods: ['POST'])]
    public function add()
    {
    }

     #[Route('/{id}', name: 'page_update', methods: ['PUT'])]
    public function update()
    {
    }

     #[Route('/{id}', name: 'page_remove', methods: ['DELETE'])]
    public function remove()
    {
    }
}
