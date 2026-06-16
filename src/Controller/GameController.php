<?php

namespace App\Controller;

use App\Entity\Game;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GameController extends AbstractController
{
    #[Route('/game/list', name: 'app_game_list')]
    public function list(GameRepository $gameRepository): Response
    {
        $games = $gameRepository->findAll();

        return $this->render('game/list.html.twig', [
            'games' => $games,
        ]);
    }

        #[Route('/game/{id}', name: 'app_game_show')]
    public function show(Game $game): Response
    {
        return $this->render('game/show.html.twig', [
            'game' => $game,
        ]);
    }

}
