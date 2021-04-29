<?php

declare(strict_types=1);

namespace App\Entity;

use App\Domain\MatchMaker\Encounter\Encounter as BaseEncounter;
use App\Domain\MatchMaker\Player\PlayerInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\EncounterRepository;

/**
 * @ORM\Entity(repositoryClass=EncounterRepository::class)
 */
class Encounter extends BaseEncounter
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected int $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected int $dateOfEncounter;

    /**
     * @ORM\Column
     */
    protected string $status = self::STATUS_PLAYING;

    /**
     * @ORM\Column(type="float")
     */
    public ?float $scorePlayerA = null;

    /**
     * @ORM\Column(type="float")
     */
    public ?float $scorePlayerB = null;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(referencedColumnName="name")
     */
    public ?PlayerInterface $playerA = null;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(referencedColumnName="name")
     */
    public ?PlayerInterface $playerB = null;
}
