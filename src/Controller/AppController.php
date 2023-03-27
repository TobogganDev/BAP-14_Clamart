<?php

namespace App\Controller;

use App\Repository\RankingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(RankingRepository $rankingRepository): Response
    {
        return $this->render('app/index.html.twig', [
            'ranks' => $rankingRepository->findAll(),
        ]);
    }
}
