<?php

namespace Kapoot\Form\Validation;

use Kapoot\Form\Field\AbstractField;
use Kapoot\Form\Field\TextField;

abstract class AbstractTextValidation extends AbstractValidation
{
    final public const string ALLOWED_FIELD_FQCN = TextField::class;

    /** @param \Kapoot\Form\Field\TextField $field */
    abstract protected function isValid(AbstractField $field, mixed $fieldData) : bool;

    /** @param \Kapoot\Form\Field\TextField $field */
    abstract protected function getError(AbstractField $field, mixed $fieldData) : string;
}