<?php

namespace Kapoot\Form\Validation;

use Kapoot\Form\Field\AbstractField;

class Min extends AbstractNumberValidation
{
    public function isValid(AbstractField $field, mixed $fieldData) : bool
    {
        return $fieldData >= $field->getMin();
    }

    public function getError(AbstractField $field, mixed $fieldData) : string
    {
        return sprintf('Le minimum pour le champ %s est %d', strtolower($field->getLabel()), $field->getMin());
    }
}