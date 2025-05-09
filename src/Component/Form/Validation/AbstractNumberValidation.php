<?php

namespace Kapoot\Form\Validation;

use Kapoot\Form\Field\AbstractField;
use Kapoot\Form\Field\NumberField;

abstract class AbstractNumberValidation extends AbstractValidation
{
    final public const string ALLOWED_FIELD_FQCN = NumberField::class;

    /** @param \Kapoot\Form\Field\NumberField $field */
    abstract protected static function isValid(AbstractField $field, mixed $fieldData) : bool;

    /** @param \Kapoot\Form\Field\NumberField $field */
    abstract protected static function getError(AbstractField $field, mixed $fieldData) : string;
}