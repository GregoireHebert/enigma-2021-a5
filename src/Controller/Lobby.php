<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Repository\LobbyRepository;
use App\Entity\Lobby as BaseLobby;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

#[Route('/lobby', name: 'lobby')]
class Lobby
{
    public function __invoke(LobbyRepository $lobbyRepository, UserInterface $user)
    {
        if (null === $lobby = $lobbyRepository->findOneBy([])) {
            $lobby = new BaseLobby();
            $lobbyRepository->persist($lobby);
        }

        if (!$lobby->isInLobby($user->getPlayer())) {
            /** @var User $user */
            $lobby->addPlayer($user->getPlayer());
            $lobbyRepository->flush();
        }

        dd($lobby);
        return new Response('');
    }
}
