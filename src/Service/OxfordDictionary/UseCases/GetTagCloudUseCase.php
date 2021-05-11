<?php

namespace App\Service\OxfordDictionary\UseCases;

use App\Entity\Searches;
use Doctrine\ORM\EntityManagerInterface;

class GetTagCloudUseCase
{

    public EntityManagerInterface $entityManager;

    /**
     * GetTagCloudUseCase constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        return $this->entityManager->getRepository(Searches::class)->createQueryBuilder('s')
            ->orderBy('s.searches', 'DESC')
            ->setMaxResults(50)
            ->getQuery()
            ->getArrayResult();
    }
}

