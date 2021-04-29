<?php

declare(strict_types=1);

namespace App\Entity;

use App\Domain\MatchMaker\Player\PlayerInterface;
use App\Domain\MatchMaker\Player\QueuingPlayer as BaseQueuingPlayer;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\QueuingPlayerRepository;

/**
 * @ORM\Entity(repositoryClass=QueuingPlayerRepository::class)
 */
class QueuingPlayer extends BaseQueuingPlayer
{
    /**
     * @ORM\Id;
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public ?int $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected int $range = 1;

    /**
     * @ORM\OneToOne(targetEntity=Player::class, cascade={"persist"})
     * @ORM\JoinColumn(nullable=false, referencedColumnName="name")
     */
    public PlayerInterface $player;
}
