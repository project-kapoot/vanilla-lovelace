<?php

namespace Kapoot\Form\Validation;

use Kapoot\Form\Field\AbstractField;

class MaxLength extends AbstractTextValidation
{
    public function isValid(AbstractField $field, mixed $fieldData) : bool
    {
        return strlen($fieldData) <= $field->getMaxLength();
    }

    public function getError(AbstractField $field, mixed $fieldData) : string
    {
        return sprintf('Le maximum pour le champ %s est %d', strtolower($field->getLabel()), $field->getMaxLength());
    }
}