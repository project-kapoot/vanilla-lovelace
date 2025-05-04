<?php

namespace Kapoot\Form\Validation;

use Kapoot\Form\Field\AbstractField;

class MaxLength implements FieldValidationInterface
{
    public function __construct(
        private readonly int $maxLength,
    ){}

    public function getMaxLength() : int
    {
        return $this->maxLength;
    }

    public function isValid(AbstractField $field, mixed $fieldData) : bool
    {
        return strlen($fieldData) <= $this->maxLength;
    }

    public function getError(AbstractField $field, mixed $fieldData) : string
    {
        return sprintf('Le maximum pour le champ %s est %d', strtolower($field->getLabel()), $this->maxLength);
    }
}