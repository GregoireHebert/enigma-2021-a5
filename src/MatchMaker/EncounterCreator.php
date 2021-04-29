<?php

declare(strict_types=1);

namespace App\MatchMaker;

class EncounterCreator
{
    public function __construct(public Lobby $lobby)
    {
    }

    public function createEncounters(): void
    {
        $this->lobby->createEncounters();

        dd($this->lobby);
    }
}
