<?php

declare(strict_types=1);

namespace App\Component\Form;

class FormValidator
{
    public function __construct(
        private readonly array $requestData,
        private readonly FieldValidator $fieldValidator,
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

            [$isValid, $errors] = $this->fieldValidator->validate($field, $fieldData);

            if(!$isValid) {
                return [true, false, $errors];
            }
        }

        return [true, true, []];
    }
}