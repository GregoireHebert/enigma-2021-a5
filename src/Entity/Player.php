<?php

declare(strict_types=1);

namespace App\Entity;

use App\Domain\MatchMaker\Player\Player as BasePlayer;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Player extends BasePlayer
{
    /**
     * @ORM\Column(type="float")
     */
    protected float $ratio;

    /**
     * @ORM\Id
     * @ORM\Column
     */
    protected string $name;
}
