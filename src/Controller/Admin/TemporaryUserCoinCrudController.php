<?php

namespace App\Controller\Admin;

use App\Entity\TemporaryUserCoin;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TemporaryUserCoinCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TemporaryUserCoin::class;
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
