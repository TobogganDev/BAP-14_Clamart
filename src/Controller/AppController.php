<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Ranking;
use App\Repository\QuestionRepository;
use App\Repository\RankingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    //#[Route('/submit-ranking', name: 'app_submit_ranking', methods: ['POST'])]
    //public function submitRanking(Request $request, EntityManagerInterface $em)
    //{
    //$name = $request->request->get('name');
    //$score = $request->request->getInt('score');

    //$ranking = new Ranking();
    //$ranking->setName($name);
    //$ranking->setScore($score);

    // $em->persist($ranking);
    // $em->flush();

    // return $this->redirectToRoute('app_question', ['id' => 1]); // Remplacez 1 par l'ID de la première question du quiz.
    //}


    #[Route('/submit-ranking', name: 'app_submit_ranking', methods: ['POST'])]
    public function submitRanking(Request $request, EntityManagerInterface $em, QuestionRepository $questionRepository)
    {
        $name = $request->request->get('name');
        $score = $request->request->getInt('score');

        $ranking = new Ranking();
        $ranking->setName($name);
        $ranking->setScore($score);

        $em->persist($ranking);
        $em->flush();

        return $this->render('app/quizz/final.html.twig');
    }

    #[Route('/quizz', name: 'app_quizz')]
    public function quizz(QuestionRepository $questionRepository, Request $request): Response
    {
        $visibleQuestion = $questionRepository->findFirstVisibleQuestion();

        return $this->render('app/quizz/quizz.html.twig', [
            'question' => $visibleQuestion,
        ]);
    }


		#[Route('/quizz/{id}', name: 'app_question', methods: ['POST'])]
		public function question(Question $question, QuestionRepository $questionRepository): Response
		{
			$nextQuestion = $questionRepository->findNextQuestion($question);
			
			while ($nextQuestion != null && $nextQuestion->isVisible() == false) {
				$nextQuestion = $questionRepository->findNextQuestion($nextQuestion);
			}

			return $this->render('app/quizz/question.html.twig', [
				'question' => $question,
				'nextQuestion' => $nextQuestion
			]);
		}
}
