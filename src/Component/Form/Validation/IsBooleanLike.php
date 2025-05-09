<?php

namespace Kapoot\Form\Validation;

use Kapoot\Form\Field\AbstractField;

class IsBooleanLike extends AbstractNumberValidation
{
    public static function isValid(AbstractField $field, mixed $data) : bool
    {
        return (new IsNumeric())->isValid($field, $data) && ($data === '0' || $data === '1');
    }

    public static function getError(AbstractField $field, mixed $fieldData) : string
    {
        return sprintf('Le champ %s doit être un nombre', $field->getLabel());
    }
}