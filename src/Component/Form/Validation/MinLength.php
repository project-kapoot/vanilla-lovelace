<?php

namespace Kapoot\Form\Validation;

use Kapoot\Form\Field\AbstractField;

class MinLength extends AbstractTextValidation
{
    public function isValid(AbstractField $field, mixed $fieldData) : bool
    {
        return strlen($fieldData) >= $field->getMinLength();
    }

    public function getError(AbstractField $field, mixed $fieldData) : string
    {
        return sprintf('Le minimum pour le champ %s est %d', strtolower($field->getLabel()), $field->getMinLength());
    }
}