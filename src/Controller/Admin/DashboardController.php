<?php

namespace App\Controller\Admin;

use App\Entity\Answers;
use App\Entity\Question;
use App\Entity\Ranking;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Bap 14');
    }

    public function configureMenuItems(): iterable
    {
	    yield MenuItem::section('Users');
			yield MenuItem::linkToCrud('User', 'fas fa-user', User::class);
			
			yield MenuItem::section('Quizz');
			yield MenuItem::linkToCrud('Question', 'fas fa-question', Question::class);
			yield MenuItem::linkToCrud('Answer', 'fas fa-list', Answers::class);
			yield MenuItem::linkToCrud('Ranking', 'fas fa-star', Ranking::class);
    }
}
