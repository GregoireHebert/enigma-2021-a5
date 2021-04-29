<?php

declare(strict_types=1);

namespace App\MatchMaker;

use App\Domain\MatchMaker\Encounter\Encounter as DomainEncounter;
use App\Domain\MatchMaker\Lobby as BaseLobby;
use App\Domain\MatchMaker\Player\InLobbyPlayerInterface;
use App\Domain\MatchMaker\Player\PlayerInterface;
use App\Entity\Encounter as EntityEncounter;
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

    public function createEncounterForPlayer(InLobbyPlayerInterface $player): void
    {
        parent::createEncounterForPlayer($player);

        foreach ($this->encounters as $encounter) {
            if ($encounter instanceof DomainEncounter) {
                $entityEncounter = new EntityEncounter();
                $entityEncounter->playerA = $encounter->playerA;
                $entityEncounter->playerB = $encounter->playerB;
                $this->encounterRepository->persist($entityEncounter);
            }
        }

        $this->encounterRepository->flush();
    }
}
