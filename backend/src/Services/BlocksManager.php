<?php

namespace App\Services;

use App\Repository\BlockRepository;

final class BlocksManager
{
    public function __construct(private BlockRepository $blockRepository)
    {

    }

    public function getBlocks(): array
    {
        return $this->blockRepository->findAll();
    }
}
