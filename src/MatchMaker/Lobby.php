<?php

declare(strict_types=1);

namespace App\MatchMaker;

use App\Domain\MatchMaker\Lobby as BaseLobby;
use App\Domain\MatchMaker\Player\PlayerInterface;
use App\Entity\QueuingPlayer;
use App\Repository\EncounterRepository;
use App\Repository\QueuingPlayerRepository;

class Lobby extends BaseLobby
{
    public function __construct(private QueuingPlayerRepository $queuingPlayerRepository, private EncounterRepository $encounterRepository)
    {
        $this->queuingPlayers = $queuingPlayerRepository->findAll();
        $this->encounters = $encounterRepository->findAll();
    }

    public function addPlayer(PlayerInterface $player): void
    {
        $queuingPlayer = new QueuingPlayer($player);
        $this->queuingPlayerRepository->persist(
            $queuingPlayer
        );
        $this->queuingPlayerRepository->flush();
        $this->queuingPlayers[] = $queuingPlayer;
    }
}
