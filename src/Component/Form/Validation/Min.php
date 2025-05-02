<?php

namespace App\Component\Form\Validation;

use App\Component\Form\Field\AbstractField;

class Min implements FieldValidationInterface
{
    public function __construct(
        private readonly int $min,
    ){}

    public function isValid(AbstractField $field, mixed $fieldData) : bool
    {
        return $fieldData >= $this->min;
    }

    public function getError(AbstractField $field, mixed $fieldData) : string
    {
        return sprintf('Le minimum pour le champ %s est %d', strtolower($field->getLabel()), $this->min);
    }
}