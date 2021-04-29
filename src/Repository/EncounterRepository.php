<?php

namespace App\Repository;

use App\Entity\Encounter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Encounter[] findAll()
 */
class EncounterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Encounter::class);
    }

    public function persist(Encounter $lobby): void
    {
        $this->_em->persist($lobby);
    }

    public function flush(): void
    {
        $this->_em->flush();
    }
}
