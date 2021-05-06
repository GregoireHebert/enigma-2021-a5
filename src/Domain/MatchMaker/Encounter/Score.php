<?php

declare(strict_types=1);

namespace App\Domain\MatchMaker\Encounter;

use App\Domain\MatchMaker\Player\PlayerInterface;

class Score
{
    public function __construct(public ?PlayerInterface $player = null, public ?int $score = null)
    {
    }
}
