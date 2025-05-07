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
        $isSubmitted = false;
        $isValid = false;
        $error = null;

        $formData = $this->requestData[$form->getName()] ?? null;

        if(!$formData === null) {
            return [$isSubmitted, $isValid, $error];
        }

        $isSubmitted = true;
        
        foreach($form->getFields() as $name => $field)
        {
            $fieldData = $formData[$field->getName()] ?? null;

            $fieldData = match($field->getDataType()) {
                'integer' => (is_numeric($fieldData)) ? (int) $fieldData : $fieldData,
                default => $fieldData
            };

            [$isValid, $error] = $this->validateField($field, $fieldData);

            if(!$isValid && null !== $error) {
                return [$isSubmitted, $isValid, $error];
            }
        }

        $isValid = true;

        return [$isSubmitted, $isValid, $error];
    }
    
    public function validateField(AbstractField $field, mixed $data) : array
    {
        $validations = $field->getValidations();

        if($field->isRequired()) {
            $validation = $field->getValidation(IsRequired::class);

            if(!$validation->isValid($field, $data)) {
                return [false, $validation->getError($field, $data)];
            }
        }

        foreach($field->getValidations() as $validation)
        {
            if($validation->isValid($field, $data)) continue;

            $error = $validation->getError($field, $data);
            
            return [false, $error];
        }

        return [true, null];
    }
}