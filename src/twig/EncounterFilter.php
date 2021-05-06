<?php

declare(strict_types=1);

namespace App\twig;

use App\Entity\Encounter;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class EncounterFilter extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('matchEnCours', [$this, 'matchEnCours']),
            new TwigFilter('matchTerminé', [$this, 'matchTerminé'])
        ];
    }

    /**
     * @param array<Encounter> $encounters
     */
    public function matchEnCours(array $encounters)
    {
        return array_filter($encounters, static function(Encounter $encounter){
            return $encounter->getStatus() === Encounter::STATUS_PLAYING;
        });
    }

    /**
     * @param array<Encounter> $encounters
     */
    public function matchTerminé(array $encounters)
    {
        return array_filter($encounters, static function(Encounter $encounter){
            return $encounter->getStatus() === Encounter::STATUS_OVER;
        });
    }
}
