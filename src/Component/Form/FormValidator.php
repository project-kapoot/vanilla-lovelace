<?php

declare(strict_types=1);

namespace Kapoot\Form;

use Kapoot\Form\Field\AbstractField;
use Kapoot\Form\Validation\IsRequired;

class FormValidator
{
    public function __construct(
        private readonly array $requestData,
    ){}

    public function validate(AbstractForm $form) : array
    {
        $formData = $this->requestData[$form->getName()] ?? null;

        if(!$formData === null) {
            return [false, true, null];
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

            [$isValid, $error] = $this->validateField($field, $fieldData);

            if(!$isValid && null !== $error) {
                return [true, false, $error];
            }
        }

        return [true, true, null];
    }
    
    public function validateField(AbstractField $field, mixed $data) : array
    {
        $errors = [];

        foreach($field->getValidations() as $validation)
        {
            if($validation->isValid($field, $data)) continue;

            $error = $validation->getError($field, $data);
            
            return [false, $error];
        }

        return [true, null];
    }
}