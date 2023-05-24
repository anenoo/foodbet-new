<?php

namespace App\Controller\Admin;

use App\Entity\UserCoinHistory;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCoinHistoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserCoinHistory::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('User')->autocomplete(),
            AssociationField::new('Category')->autocomplete(),
            AssociationField::new('Idea')->autocomplete(),
            NumberField::new('coin'),
            DateTimeField::new('createdAT'),
        ];
    }
}
