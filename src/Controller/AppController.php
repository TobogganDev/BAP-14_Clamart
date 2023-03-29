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

        $firstVisibleQuestion = $questionRepository->findFirstVisibleQuestion();
        if ($firstVisibleQuestion !== null) {
            return $this->redirectToRoute('app_question', ['id' => $firstVisibleQuestion->getId()]);
        } else {
            // Gérer le cas où aucune question visible n'est trouvée.
            // Vous pouvez rediriger l'utilisateur vers une autre page ou afficher un message d'erreur.
            return $this->redirectToRoute('app_index');
        }
    }

    #[Route('/quizz', name: 'app_quizz')]
    public function quizz(QuestionRepository $questionRepository, Request $request): Response
    {
        // Initialisez la session et définissez le score sur 0
        $session = $request->getSession();
        $session->set('score', 0);

        $visibleQuestion = $questionRepository->findFirstVisibleQuestion();

        return $this->render('app/quizz/quizz.html.twig', [
            'question' => $visibleQuestion,
        ]);
    }


		#[Route('/quizz/{id}', name: 'app_question')]
		public function question(Question $question, QuestionRepository $questionRepository, RankingRepository $rankingRepository, Request $request): Response
		{
			$nextQuestion = $questionRepository->findNextQuestion($question);
			
			while ($nextQuestion != null && $nextQuestion->isVisible() == false) {
				$nextQuestion = $questionRepository->findNextQuestion($nextQuestion);
			}

            $submittedAnswer = $request->get('answer');

            var_dump($submittedAnswer);
            $rightAnswerIndex = $question->getRightAnswer();
            $session = $request->getSession();
            $currentScore = $session->get('score', 0);
            var_dump($currentScore);
            if ($submittedAnswer && $question->getAnswers()[$rightAnswerIndex] === $submittedAnswer) {

                $session = $request->getSession();
                $currentScore = $session->get('score', 0);
                var_dump($currentScore);
                $session->set('score', $currentScore + 1); // Maj du score
            } else {
                print_r('Mauvaise réponse');
            }



            $session = $request->getSession();
            $userScore = $session->get('score', 0);
            // Vérifiez si la réponse soumise est correcte
			
			return $this->render('app/quizz/question.html.twig', [
				'question' => $question,
				'nextQuestion' => $nextQuestion,
                'ranks' => $rankingRepository->findAll(),
                'user_score' => $userScore,
			]);
		}
}
