<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PageController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(GameRepository $gameRepository): Response
    {
        $games = $gameRepository->findby([], ['releaseDate' => 'DESC'], 3);
        return $this->render('page/index.html.twig', [
            'games' => $games,
        ]);
    }
    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('page/about.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }
        #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('page/contact.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

        #[Route('/games', name: 'app_games')]
    public function games(): Response
    {
        return $this->render('page/games.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

}
