<?php

namespace Kapoot\Form\Validation;

use Kapoot\Form\Field\Abstract\AbstractField;
use Kapoot\Form\Validation\Abstract\AbstractNumberValidation;

class Min extends AbstractNumberValidation
{
    public static function isValid(AbstractField $field, mixed $fieldData) : bool
    {
        return $fieldData >= $field->getMin();
    }

    public static function getError(AbstractField $field, mixed $fieldData) : string
    {
        return sprintf('Le minimum pour le champ %s est %d', strtolower($field->getLabel()), $field->getMin());
    }
}