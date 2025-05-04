<?php

namespace Kapoot\Form\Validation;

use Kapoot\Form\Field\AbstractField;

class Min implements FieldValidationInterface
{
    public function __construct(
        private readonly int $min,
    ){}

    public function getMin() : int
    {
        return $this->min;
    }

    public function isValid(AbstractField $field, mixed $fieldData) : bool
    {
        return $fieldData >= $this->min;
    }

    public function getError(AbstractField $field, mixed $fieldData) : string
    {
        return sprintf('Le minimum pour le champ %s est %d', strtolower($field->getLabel()), $this->min);
    }
}