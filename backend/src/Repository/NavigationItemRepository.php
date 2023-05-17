<?php

namespace App\Repository;

use App\Entity\NavigationItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NavigationItem>
 *
 * @method NavigationItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method NavigationItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method NavigationItem[]    findAll()
 * @method NavigationItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NavigationItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NavigationItem::class);
    }
}
