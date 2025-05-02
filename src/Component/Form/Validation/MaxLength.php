<?php

namespace App\Component\Form\Validation;

use App\Component\Form\Field\AbstractField;

class MaxLength implements FieldValidationInterface
{
    public function __construct(
        private readonly int $maxLength,
    ){}

    public function isValid(AbstractField $field, mixed $fieldData) : bool
    {
        return strlen($fieldData) <= $this->maxLength;
    }

    public function getError(AbstractField $field, mixed $fieldData) : string
    {
        return sprintf('Le maximum pour le champ %s est %d', strtolower($field->getLabel()), $this->maxLength);
    }
}