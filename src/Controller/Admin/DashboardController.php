<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Commentary;
use App\Entity\Category;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator){}
    #[Route('/admin', name: 'admin')]
    #[Route('/admin', name: 'admin')]
public function index(): Response
{
$url = $this->adminUrlGenerator
->setController(ArticleCrudController::class)
->generateUrl();
return $this->redirect($url);
}

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Cyber');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('User', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Category', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Commentaire', 'fas fa-list', Commentary::class);
        yield MenuItem::linkToCrud('Article', 'fas fa-list', Article::class);
    }
}
