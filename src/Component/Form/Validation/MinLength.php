<?php

namespace App\Component\Form\Validation;

use App\Component\Form\Field\AbstractField;

class MinLength implements FieldValidationInterface
{
    public function __construct(
        private readonly int $minLength,
    ){}

    public function isValid(AbstractField $field, mixed $fieldData) : bool
    {
        return strlen($fieldData) >= $this->minLength;
    }

    public function getError(AbstractField $field, mixed $fieldData) : string
    {
        return sprintf('Le minimum pour le champ %s est %d', strtolower($field->getLabel()), $this->minLength);
    }
}