<?php

namespace App\Controller;

use App\Repository\QuestionRepository;
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
	
	
	
		#[Route('/quizz', name: 'app_quizz')]
		public function quizz(): Response
		{
			return $this->render('app/quizz/quizz.html.twig');
		}
		
		#[Route('/quizz/1', name: 'app_quizz_1')]
		public function quizz1(QuestionRepository $questionRepository): Response
		{
			return $this->render('app/quizz/quizz1.html.twig', [
				'question' => $questionRepository->findOneByVisible(1)
			]);
		}
}
