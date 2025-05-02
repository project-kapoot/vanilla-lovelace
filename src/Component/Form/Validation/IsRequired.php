<?php

namespace App\Component\Form\Validation;

use App\Component\Form\Field\AbstractField;

class IsRequired implements FieldValidationInterface
{
    public function isValid(AbstractField $field, mixed $fieldData) : bool
    {
        if($field->isRequired() && "" === $fieldData) {
            return false;
        }

        return true;
    }

    public function getError(AbstractField $field, mixed $fieldData) : string
    {
        return sprintf('Le champ %s est requis', strtolower($field->getLabel()));
    }
}