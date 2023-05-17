<?php

namespace App\Controller\API;

use App\Controller\RESTController;
use App\Services\NavigationItemsManager;
use Predis\ClientInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('navigation')]
class NavigationItemController extends RESTController
{
    #[Route('/items', name: 'navigation_item_list', methods: ['GET'])]
    public function list(NavigationItemsManager $navigationItemsManager): Response
    {
        $navigationItems = $navigationItemsManager->getNavigationItems();

        return $this->json($navigationItems);
    }

     #[Route('/item/{id}', name: 'navigation_item_self', methods: ['GET'])]
    public function self()
    {
    }

     #[Route('/item', name: 'navigation_item_add', methods: ['POST'])]
    public function add()
    {
    }

     #[Route('/item/{id}', name: 'navigation_item_update', methods: ['PUT'])]
    public function update()
    {
    }

     #[Route('/item/{id}', name: 'navigation_item_remove', methods: ['DELETE'])]
    public function remove()
    {
    }
}
