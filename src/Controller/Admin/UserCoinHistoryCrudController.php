<?php

namespace App\Controller\Admin;

use App\Entity\UserCoinHistory;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCoinHistoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserCoinHistory::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
