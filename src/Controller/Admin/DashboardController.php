<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Entity\Game;
use App\Entity\Genre;
use App\Entity\Review;
use App\Entity\WishlistItem;


#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
       return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('All Games');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkTo(EditorCrudController::class,'Users', 'fa-solid fa-users');
        yield MenuItem::linkTo(EditorCrudController::class,'Games', 'fa-solid fa-gamepad');
        yield MenuItem::linkTo(EditorCrudController::class,'Genres', 'fa-solid fa-tags');
        yield MenuItem::linkTo(EditorCrudController::class,'Review', 'fa-solid fa-star');
        yield MenuItem::linkTo(EditorCrudController::class,'Wishlist', 'fa-solid fa-heart' );

    }
}
