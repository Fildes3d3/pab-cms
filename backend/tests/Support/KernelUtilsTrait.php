<?php

namespace App\Tests\Support;

use App\Entity\Block;
use App\Services\FixtureManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

trait KernelUtilsTrait
{
    public function getFixtureManager(ContainerInterface $container): FixtureManager
    {
         return $container->get(FixtureManager::class);
    }
    public function getEntityManager(ContainerInterface $container): EntityManagerInterface
    {
        return $container->get('doctrine.orm.entity_manager');
    }

    public function purgeTables(ContainerInterface $container, array $tables): void
    {
        $em = $this->getEntityManager($container);

        \array_walk(
            $tables,
            fn (string $table) => $em->getRepository($table)
                ->createQueryBuilder('d')
                ->delete()
                ->getQuery()
                ->execute()
        );

        $em->flush();
    }
}
