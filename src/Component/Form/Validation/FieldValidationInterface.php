<?php

namespace App\Component\Form\Validation;

use App\Component\Form\Field\AbstractField;

interface FieldValidationInterface
{
    public function isValid(AbstractField $field, mixed $fieldData) : bool;

    public function getError(AbstractField $field, mixed $fieldData) : string;
}