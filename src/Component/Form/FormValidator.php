<?php

declare(strict_types=1);

namespace Kapoot\Form;

use Kapoot\Form\Field\AbstractField;

class FormValidator
{
    public function __construct(
        private readonly array $requestData,
    ){}

    public function validate(AbstractForm $form) : array
    {
        $formData = $this->requestData[$form->getName()] ?? null;

        if(!$formData === null) {
            return [false, true, []];
        }

        foreach($form->getFields() as $name => $field)
        {
            $fieldData = $formData[$field->getName()] ?? null;

            if($fieldData === null) {
                return [true, false, []];
            }

            $fieldData = match($field->getDataType()) {
                'integer' => (is_numeric($fieldData)) ? (int) $fieldData : $fieldData,
                default => $fieldData
            };

            [$isValid, $errors] = $this->validateField($field, $fieldData);

            if(!$isValid) {
                return [true, false, $errors];
            }
        }

        return [true, true, []];
    }
    
    public function validateField(AbstractField $field, mixed $data) : array
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