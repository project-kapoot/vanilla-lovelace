<?php

namespace Kapoot\Form\Validation;

use Kapoot\Form\Field\AbstractField;
use Kapoot\Form\Field\ChoiceField;

abstract class AbstractChoiceValidation extends AbstractValidation
{
    final public const string ALLOWED_FIELD_FQCN = ChoiceField::class;

    /** @param \Kapoot\Form\Field\ChoiceField $field */
    abstract protected function isValid(AbstractField $field, mixed $fieldData) : bool;

    /** @param \Kapoot\Form\Field\ChoiceField $field */
    abstract protected function getError(AbstractField $field, mixed $fieldData) : string;
}