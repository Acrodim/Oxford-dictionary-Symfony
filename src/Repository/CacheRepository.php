<?php

namespace App\Repository;

use App\Entity\Cache;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cache|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cache|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cache[]    findAll()
 * @method Cache[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CacheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cache::class);
    }
}
