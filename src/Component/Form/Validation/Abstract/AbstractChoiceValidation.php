<?php

namespace Kapoot\Form\Validation\Abstract;

use Kapoot\Form\Field\Abstract\AbstractField;
use Kapoot\Form\Field\ChoiceField;

abstract class AbstractChoiceValidation extends AbstractValidation
{
    final public const string ALLOWED_FIELD_FQCN = ChoiceField::class;

    /** @param \Kapoot\Form\Field\ChoiceField $field */
    abstract protected static function isValid(AbstractField $field, mixed $fieldData) : bool;

    /** @param \Kapoot\Form\Field\ChoiceField $field */
    abstract protected static function getError(AbstractField $field, mixed $fieldData) : string;
}