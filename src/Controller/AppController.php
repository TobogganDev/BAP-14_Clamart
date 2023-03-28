<?php

namespace App\Controller;

use App\Entity\Question;
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
		public function quizz(QuestionRepository $questionRepository): Response
		{
			$visibleQuestion = $questionRepository->findFirstVisibleQuestion();
			return $this->render('app/quizz/quizz.html.twig', [
				'question' => $visibleQuestion,
			]);
		}
		
		#[Route('/quizz/{id}', name: 'app_question')]
		public function question(Question $question, QuestionRepository $questionRepository): Response
		{
			$nextQuestion = $questionRepository->findNextQuestion($question);
			
			while ($nextQuestion != null && $nextQuestion->isVisible() == false) {
				$nextQuestion = $questionRepository->findNextQuestion($nextQuestion);
			}
			
			return $this->render('app/quizz/quizz1.html.twig', [
				'question' => $question,
				'nextQuestion' => $nextQuestion,
			]);
		}
}
