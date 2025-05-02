<?php

namespace App\Component\Form\Validation;

use App\Component\Form\Field\AbstractField;

class InArray implements FieldValidationInterface
{
    public function __construct(
        private readonly array $choices,
    ){}

    public function isValid(AbstractField $field, mixed $fieldData) : bool
    {
        return in_array($fieldData, $this->choices, true);
    }

    public function getError(AbstractField $field, mixed $fieldData) : string
    {
        return sprintf('Le champ %s ne peux avoir que les valeurs suivantes : %s', strtolower($field->getLabel()), implode(', ', $this->choices));
    }
}