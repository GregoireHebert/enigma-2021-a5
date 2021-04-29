<?php

declare(strict_types=1);

namespace App\Controller;

use App\Domain\Exceptions\NotFoundPlayersException;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Twig\Environment;
use App\MatchMaker\Lobby as LobbyService;

#[Route('/lobby', name: 'lobby')]
class Lobby
{
    public function __invoke(LobbyService $lobby, UserInterface $user, Environment $twig)
    {
        try {
            $lobby->isInLobby($user->getPlayer());
        } catch(NotFoundPlayersException) {
            /** @var User $user */
            $lobby->addPlayer($user->getPlayer());
        }

        return new Response(
            $twig->render('lobby/index.html.twig',
                [
                    'players' => $lobby->queuingPlayers
                ]
            )
        );
    }
}
