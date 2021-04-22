<?php

declare(strict_types=1);

namespace App\Entity;

use App\Domain\MatchMaker\Player\PlayerInterface;
use App\Domain\MatchMaker\Player\QueuingPlayer as BaseQueuingPlayer;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class QueuingPlayer extends BaseQueuingPlayer
{
    /**
     * @ORM\Id;
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public int $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected int $range = 1;

    /**
     * @ORM\OneToOne(targetEntity=Player::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false, referencedColumnName="name")
     */
    protected PlayerInterface $player;
}