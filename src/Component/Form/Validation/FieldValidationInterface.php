<?php

namespace Kapoot\Form\Validation;

use Kapoot\Form\Field\AbstractField;

interface FieldValidationInterface
{
    public function isValid(AbstractField $field, mixed $fieldData) : bool;

    public function getError(AbstractField $field, mixed $fieldData) : string;
}