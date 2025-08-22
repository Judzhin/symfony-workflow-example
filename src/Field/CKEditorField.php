<?php

namespace App\Field;

use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

final class CKEditorField implements FieldInterface
{
    use FieldTrait;

    /**
     * @param string $propertyName
     * @param string|null $label
     * @return CKEditorField|FieldInterface
     */
    public static function new(string $propertyName, ?string $label = null)
    {
        return (new self)
            ->setProperty($propertyName)
            ->setLabel($label)
            // this template is used in 'index' and 'detail' pages
            // ->setTemplatePath('@EasyAdmin/crud/field/text_editor.html.twig')
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
            // this is used in 'edit' and 'new' pages to edit the field contents
            // you can use your own form types too
            ->setFormType(CKEditorType::class)
            ->setFormTypeOptions([
                // 'config_name' => 'default',
                'config' => [
                    // 'toolbar' => 'full',
                    // 'filebrowserUploadRoute' => 'post_ckeditor_image',
                    // 'filebrowserUploadRouteParameters' => ['slug' => 'image'],
                    // 'extraPlugins' => 'templates',
                    'rows' => '40',

                ],
                'attr' => ['rows' => '40'],

            ])->addCssClass('field-ck-editor');
    }
}
