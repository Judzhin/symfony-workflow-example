<?php

namespace App\Field;

use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReadOnlyField implements FieldInterface
{
    use FieldTrait;

    /**
     * @param string $propertyName
     * @param $label
     * @return FieldInterface
     */
    public static function new(string $propertyName, $label = null): FieldInterface
    {
        return TextField::new($propertyName, $label)
            ->onlyOnForms()
            ->onlyWhenUpdating()
            ->setFormTypeOption('disabled', true);
    }
}
