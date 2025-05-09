<?php

namespace Kapoot\Form\Validation;

use Kapoot\Form\Field\AbstractField;

class IsString extends AbstractTextValidation
{
    public function isValid(AbstractField $field, mixed $data) : bool
    {
        return gettype($data) === 'string';
    }

    public function getError(AbstractField $field, mixed $fieldData) : string
    {
        return sprintf('Le champ %s doit être une chaîne de caractères', $field->getLabel());
    }
}