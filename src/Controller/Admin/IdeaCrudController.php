<?php

namespace App\Controller\Admin;

use App\Entity\Idea;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class IdeaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Idea::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            NumberField::new('status'),
            TextField::new('title'),
            TextEditorField::new('description'),
            AssociationField::new('User')->autocomplete(),
            AssociationField::new('category')->autocomplete(),
        ];
    }
}
