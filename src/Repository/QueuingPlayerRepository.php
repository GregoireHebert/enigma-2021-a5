<?php

namespace App\Repository;

use App\Entity\QueuingPlayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QueuingPlayer[] findAll()
 */
class QueuingPlayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QueuingPlayer::class);
    }

    public function persist(QueuingPlayer $queuingPlayer): void
    {
        $this->_em->persist($queuingPlayer);
    }

    public function remove(QueuingPlayer $queuingPlayer): void
    {
        $this->_em->remove($queuingPlayer);
    }

    public function flush(): void
    {
        $this->_em->flush();
    }
}
