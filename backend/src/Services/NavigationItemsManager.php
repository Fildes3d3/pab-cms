<?php

namespace App\Services;

use App\Repository\NavigationItemRepository;

final class NavigationItemsManager
{
    public function __construct(private NavigationItemRepository $navigationItemRepository)
    {

    }

    public function getNavigationItems(): array
    {
        return $this->navigationItemRepository->findAll();
    }
}
