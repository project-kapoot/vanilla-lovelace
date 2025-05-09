<?php

namespace Kapoot\Form\Validation;

use Kapoot\Form\Field\Abstract\AbstractField;
use Kapoot\Form\Validation\Abstract\AbstractTextValidation;

class MinLength extends AbstractTextValidation
{
    public static function isValid(AbstractField $field, mixed $fieldData) : bool
    {
        return strlen($fieldData) >= $field->getMinLength();
    }

    public static function getError(AbstractField $field, mixed $fieldData) : string
    {
        return sprintf('Le minimum pour le champ %s est %d', strtolower($field->getLabel()), $field->getMinLength());
    }
}