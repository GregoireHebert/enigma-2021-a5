<?php

declare(strict_types=1);

namespace App\MatchMaker;

use App\Repository\EncounterRepository;

class EncounterCreator
{
    public function __construct(private Lobby $lobby, private EncounterRepository $encounterRepository)
    {
    }

    public function createEncounters(): void
    {
        $this->lobby->createEncounters();
        dd($this->lobby);
    }
}
