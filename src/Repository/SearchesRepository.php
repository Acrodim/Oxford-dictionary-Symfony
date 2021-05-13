<?php

namespace App\Repository;

use App\Entity\Searches;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Searches|null find($id, $lockMode = null, $lockVersion = null)
 * @method Searches|null findOneBy(array $criteria, array $orderBy = null)
 * @method Searches[]    findAll()
 * @method Searches[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SearchesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Searches::class);
    }

    public function incrementWord($word)
    {
        $entity = $this->findOneBy(['word' => $word]);
        if (!$entity) {
            $entity = new Searches();
            $entity->setWord($word);
        }
        $searches = $entity->getSearches();
        $entity->setSearches(++$searches);

        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

}

