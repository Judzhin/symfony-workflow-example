<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use App\Field\ReadOnlyField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TagCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tag::class;
    }


    /**
     * @param string $pageName
     * @return iterable
     */
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
