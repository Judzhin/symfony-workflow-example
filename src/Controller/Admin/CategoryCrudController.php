<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Field\ReadOnlyField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield TextField::new('title');
        yield ReadOnlyField::new('slug');
        yield DateTimeField::new('createdAt')
            ->onlyOnIndex();
        yield DateTimeField::new('updatedAt')
            ->onlyOnIndex();
    }

}
