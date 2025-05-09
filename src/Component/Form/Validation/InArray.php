<?php

namespace Kapoot\Form\Validation;

use Kapoot\Form\Field\AbstractField;

class InArray extends AbstractChoiceValidation
{
    protected static function isValid(AbstractField $field, mixed $fieldData) : bool
    {
        return in_array($fieldData, $field->getChoices(), true);
    }

    public static function getError(AbstractField $field, mixed $fieldData) : string
    {
        return sprintf('Le champ %s ne peux avoir que les valeurs suivantes : %s', strtolower($field->getLabel()), implode(', ', $field->getChoices()));
    }
}