<?php

namespace Kapoot\Form\Validation;

use Kapoot\Form\Field\AbstractField;

abstract class AbstractValidation
{
    public const string ALLOWED_FIELD_FQCN = AbstractField::class;

    abstract protected function isValid(AbstractField $field, mixed $fieldData) : bool;

    abstract protected function getError(AbstractField $field, mixed $fieldData) : string;

    final public function validate(AbstractField $field, mixed $data) : array
    {
        $allowedFieldFqcn = self::ALLOWED_FIELD_FQCN;

        if(!($field instanceof $allowedFieldFqcn)) {
            throw new \InvalidArgumentException('Argument "$field" must be an instance of ' . $allowedFieldFqcn);
        }

        return ($this->isValid($field, $data)) ? [true, null] : [false, $this->getError($field, $data)];
    } 
}