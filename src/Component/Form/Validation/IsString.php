<?php

namespace Kapoot\Form\Validation;

use Kapoot\Form\Field\Abstract\AbstractField;
use Kapoot\Form\Validation\Abstract\AbstractTextValidation;

class IsString extends AbstractTextValidation
{
    public static function isValid(AbstractField $field, mixed $data) : bool
    {
        return gettype($data) === 'string';
    }

    public static function getError(AbstractField $field, mixed $fieldData) : string
    {
        return sprintf('Le champ %s doit être une chaîne de caractères', $field->getLabel());
    }
}