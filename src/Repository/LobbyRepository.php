<?php

namespace App\Repository;

use App\Domain\MatchMaker\LobbyInterface;
use App\Entity\Lobby;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Lobby findOneBy(array $criteria, ?array $orderBy = null)
 */
class LobbyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lobby::class);
    }

    public function persist(LobbyInterface $lobby): void
    {
        $this->_em->persist($lobby);
    }

    public function flush(): void
    {
        $this->_em->flush();
    }
}
