<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Field\ReadOnlyField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
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

        yield ChoiceField::new('type')
            ->setChoices([
                'Draft' => Post::TYPE_DRAFT,
                'Published' => Post::TYPE_PUBLISHED,
            ]);

        yield AssociationField::new('category')
            ->setRequired(true);

        yield TextField::new('shortDescription')
            ->onlyOnForms();
        yield TextEditorField::new('description')
            ->onlyOnForms();

        yield AssociationField::new('tags')
            ->onlyOnForms();

        yield AssociationField::new('author')
            ->setRequired(true);
        yield DateTimeField::new('publishedAt');

        yield DateTimeField::new('createdAt')
            ->onlyOnIndex();
        yield DateTimeField::new('updatedAt')
            ->onlyOnIndex();
    }

}
