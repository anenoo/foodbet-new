<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Idea;
use App\Entity\User;
use App\Entity\UserCoinHistory;
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
        try
        {
            $adminUrlGenerator = $this -> container -> get(AdminUrlGenerator::class);

            return $this -> redirect($adminUrlGenerator -> setController(CategoryCrudController::class) -> generateUrl());
        }
        catch (\Throwable $e)
        {
            dd($e);
        }
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            // the name visible to end users
            ->setTitle('Foodbet Backoffice')
            // you can include HTML contents too (e.g. to link to an image)
            // the domain used by default is 'messages'

            // there's no need to define the "text direction" explicitly because
            // its default value is inferred dynamically from the user locale
            ->setTextDirection('ltr')

            // set this option if you prefer the page content to span the entire
            // browser width, instead of the default design which sets a max width
            ->renderContentMaximized()

            // set this option if you prefer the sidebar (which contains the main menu)
            // to be displayed as a narrow column instead of the default expanded design

            // by default, users can select between a "light" and "dark" mode for the
            // backend interface. Call this method if you prefer to disable the "dark"
            // mode for any reason (e.g. if your interface customizations are not ready for it)
            ->disableDarkMode()

            // by default, all backend URLs are generated as absolute URLs. If you
            // need to generate relative URLs instead, call this method
            ->generateRelativeUrls()
            ;
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToCrud('Category', 'fa fa-book', Category::class),
            MenuItem::linkToCrud('Idea', 'fa fa-box', Idea::class),
            MenuItem::linkToCrud('User', 'fa fa-tags', User::class),
            MenuItem::linkToCrud('Coin', 'fa fa-file', UserCoinHistory::class),
        ];
    }
}
