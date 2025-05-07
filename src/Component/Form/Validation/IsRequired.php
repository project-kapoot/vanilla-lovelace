<?php

namespace Kapoot\Form\Validation;

use Kapoot\Form\Field\AbstractField;

class IsRequired implements FieldValidationInterface
{
    public function isValid(AbstractField $field, mixed $fieldData) : bool
    {
        if($fieldData === '' || $fieldData === null) {
            return false;
        }

        return true;
    }

    public function getError(AbstractField $field, mixed $fieldData) : string
    {
        return sprintf('Le champ %s est requis', strtolower($field->getLabel()));
    }
}