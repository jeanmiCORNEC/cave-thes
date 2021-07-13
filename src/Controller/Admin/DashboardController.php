<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/biquette", name="biquette")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('cave');
    }

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linktoDashboard('Tableau de Bord', 'fa fa-home');
        yield MenuItem::linkToRoute('retour à la cave', 'fas fa-cart', 'main');
        yield MenuItem::linkToCrud('Evénement', 'fas fa-bullhorn', Event::class);
    }
}
