<?php

namespace App\Component\Form\Validation;

use App\Component\Form\Field\AbstractField;

class Max implements FieldValidationInterface
{
    public function __construct(
        private readonly int $max,
    ){}

    public function isValid(AbstractField $field, mixed $fieldData) : bool
    {
        return $fieldData <= $this->max;
    }

    public function getError(AbstractField $field, mixed $fieldData) : string
    {
        return sprintf('Le minimum pour le champ %s est %d', strtolower($field->getLabel()), $this->max);
    }
}