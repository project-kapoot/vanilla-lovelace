<?php

namespace Kapoot\Form\Validation;

use Kapoot\Form\Field\Abstract\AbstractField;

class IsEmail extends IsString
{
    public static function isValid(AbstractField $field, mixed $fieldData): bool
    {
        return filter_var($fieldData, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function getError(AbstractField $field, mixed $fieldData): string
    {
        return 'Le champ ' . $field->getName() . ' n\'est pas un email valide';
    }
}