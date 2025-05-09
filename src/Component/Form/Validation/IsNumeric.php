<?php

namespace Kapoot\Form\Validation;

use Kapoot\Form\Field\AbstractField;

class IsNumeric extends AbstractNumberValidation
{
    public static function isValid(AbstractField $field, mixed $data) : bool
    {
        return is_numeric($data);
    }

    public static function getError(AbstractField $field, mixed $fieldData) : string
    {
        return sprintf('Le champ %s doit être un nombre', $field->getLabel());
    }
}