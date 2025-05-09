<?php

namespace Kapoot\Form\Validation;

use Kapoot\Form\Field\Abstract\AbstractField;
use Kapoot\Form\Validation\Abstract\AbstractNumberValidation;

class Max extends AbstractNumberValidation
{
    public static function isValid(AbstractField $field, mixed $fieldData) : bool
    {
        return $fieldData <= $field->getMax();
    }

    public static function getError(AbstractField $field, mixed $fieldData) : string
    {
        return sprintf('Le maximum pour le champ %s est %d', strtolower($field->getLabel()), $field->getMax());
    }
}