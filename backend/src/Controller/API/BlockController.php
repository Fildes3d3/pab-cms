<?php

namespace App\Controller\API;

use App\Controller\RESTController;
use App\Services\BlocksManager;
use Predis\ClientInterface;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/preview', name: 'block_preview_add', methods: ['POST'])]
    public function addPreview(Request $request, ClientInterface $clientInterface): Response
    {
        if (null ===  $this->requiresAuthentication()) {
            return $this->json([], 401);
        }

        $data = $request->getContent();
        $content = json_decode($data, true);

        if (isset($content['id'])) {
            $clientInterface->set($content['id'], $data);
            $clientInterface->expire($content['id'], self::PREVIEW_EXP_SECONDS);

            return $this->json($data);
        }

        return $this->json([], Response::HTTP_BAD_REQUEST);
    }

    #[Route('/preview/{id}', name: 'block_preview_self', methods: ['GET'])]
    public function selfPreview($id, ClientInterface $client): Response
    {

        $preview = json_decode($client->get($id));

        if ($preview) {
            return $this->json($preview);
        }

        return $this->json([], Response::HTTP_NOT_FOUND);
    }
}
