<?php

namespace App\Field;

use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReadOnlyField
{
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
