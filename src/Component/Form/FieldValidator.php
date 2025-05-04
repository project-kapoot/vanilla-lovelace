<?php

namespace Kapoot\Form;

use Kapoot\Form\Field\AbstractField;

class FieldValidator
{
    public function validate(AbstractField $field, mixed $data) : array
    {
        $errors = [];

        foreach($field->getValidations() as $validation)
        {
            if($validation->isValid($field, $data)) continue;

            $errors[] = $validation->getError($field, $data);
        }

        $isValid = count($errors) === 0;

        return [$isValid, $errors];
    }
}