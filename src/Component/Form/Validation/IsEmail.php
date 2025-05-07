<?php

namespace Kapoot\Form\Validation;

use Kapoot\Form\Field\AbstractField;

class IsEmail implements FieldValidationInterface
{
    public function isValid(AbstractField $field, mixed $fieldData): bool
    {
        return filter_var($fieldData, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function getError(AbstractField $field, mixed $fieldData): string
    {
        return 'Le champ ' . $field->getName() . ' n\'est pas un email valide';
    }
}