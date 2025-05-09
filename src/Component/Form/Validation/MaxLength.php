<?php

namespace Kapoot\Form\Validation;

use Kapoot\Form\Field\Abstract\AbstractField;
use Kapoot\Form\Validation\Abstract\AbstractTextValidation;

class MaxLength extends AbstractTextValidation
{
    public static function isValid(AbstractField $field, mixed $fieldData) : bool
    {
        return strlen($fieldData) <= $field->getMaxLength();
    }

    public static function getError(AbstractField $field, mixed $fieldData) : string
    {
        return sprintf('Le maximum pour le champ %s est %d', strtolower($field->getLabel()), $field->getMaxLength());
    }
}