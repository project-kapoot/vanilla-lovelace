<?php

namespace Kapoot\Form\Validation;

use Kapoot\Form\Field\AbstractField;

abstract class AbstractValidation
{
    public const string ALLOWED_FIELD_FQCN = AbstractField::class;

    abstract protected static function isValid(AbstractField $field, mixed $fieldData) : bool;

    abstract protected static function getError(AbstractField $field, mixed $fieldData) : string;

    final public static function validate(AbstractField $field, mixed $data) : array
    {
        $allowedFieldFqcn = static::ALLOWED_FIELD_FQCN;

        if(!($field instanceof $allowedFieldFqcn)) {
            throw new \InvalidArgumentException('Argument "$field" must be an instance of ' . $allowedFieldFqcn);
        }

        return (static::isValid($field, $data)) ? [true, null] : [false, static::getError($field, $data)];
    } 
}