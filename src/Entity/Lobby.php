<?php

declare(strict_types=1);

namespace App\Entity;

use App\Domain\MatchMaker\Lobby as BaseLobby;
use App\Domain\MatchMaker\Player\PlayerInterface;
use App\Repository\LobbyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LobbyRepository::class)
 */
class Lobby extends BaseLobby
{
    /**
     * @ORM\Id;
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public int $id;

    /**
     * @ORM\ManyToMany(targetEntity=QueuingPlayer::class, cascade={"persist"})
     * @ORM\JoinTable(name="lobby_queuingplayer",
     *      joinColumns={@ORM\JoinColumn(name="lobby_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="queuingplayer_id", referencedColumnName="id", unique=true)}
     * )
     */
    public iterable $queuingPlayers;

    public function addPlayer(PlayerInterface $player): void
    {
        $this->queuingPlayers[] = new QueuingPlayer($player);
    }
}
