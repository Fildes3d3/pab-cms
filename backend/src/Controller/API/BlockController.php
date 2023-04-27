<?php

namespace App\Controller\API;

use App\Controller\RESTController;
use App\Services\BlocksManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('block')]
class BlockController extends RESTController
{
    #[Route('/', name: 'block_list', methods: ['GET'])]
    public function list(BlocksManager $blocksManager): Response
    {
        $blocks = $blocksManager->getBlocks();

        return $this->json($blocks);
    }

     #[Route('/{id}', name: 'block_self', methods: ['GET'])]
    public function self()
    {
    }

     #[Route('/', name: 'block_add', methods: ['POST'])]
    public function add()
    {
    }

     #[Route('/{id}', name: 'block_update', methods: ['PUT'])]
    public function update()
    {
    }

     #[Route('/{id}', name: 'block_remove', methods: ['DELETE'])]
    public function remove()
    {
    }
}
