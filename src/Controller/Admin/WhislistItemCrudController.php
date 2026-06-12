<?php

namespace App\Controller\Admin;

use App\Entity\WhislistItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class WhislistItemCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return WhislistItem::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateTimeField::new('createdAt'),
            AssociationField::new('user')->autocomplete(),
        ];
    }
}
