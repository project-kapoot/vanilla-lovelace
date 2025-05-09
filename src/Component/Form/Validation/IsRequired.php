<?php

namespace Kapoot\Form\Validation;

use Kapoot\Form\Field\Abstract\AbstractField;
use Kapoot\Form\Validation\Abstract\AbstractValidation;

class IsRequired extends AbstractValidation
{
    public static function isValid(AbstractField $field, mixed $fieldData) : bool
    {
        if($fieldData === '' || $fieldData === null) {
            return false;
        }

        return true;
    }

    public static function getError(AbstractField $field, mixed $fieldData) : string
    {
        return sprintf('Le champ %s est requis', strtolower($field->getLabel()));
    }
}