<?php

declare(strict_types=1);

namespace App\Controller;

use App\MatchMaker\EncounterCreator;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/lobby/create_encounters', name: 'create_encounters')]
class CreateEncounters
{
    public function __invoke(EncounterCreator $encounterCreator)
    {
        $encounterCreator->createEncounters();

        return new RedirectResponse($_SERVER['HTTP_REFERER']);
    }
}
