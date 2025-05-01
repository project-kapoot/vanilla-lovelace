<?php

declare(strict_types=1);

namespace App\Component\Form;

use App\Component\Form\Field\AbstractField;

class Form 
{
    public function __construct(
        private readonly string $prefix,
        private readonly FieldCollection $fieldCollection,
    ){}

    public function getField(string $name) : AbstractField
    {
        return $this->fieldCollection->get($name);
    }

    public function getPrefix() : string
    {
        return $this->prefix;
    }

    public function isSubmitted(array $formData) : bool
    {
        return isset($formData[$this->prefix]);
    }

    public function isValid(array $formData) : bool
    {
        $formData = $formData[$this->getPrefix()] ?? null;
        
        if(null === $formData) {
            return false;
        }

        foreach($this->fieldCollection as $field)
        {
            $fieldData = $formData[$field->getName()] ?? null;

            if($fieldData === null) {
                return false;
            }

            $fieldData = match($field->getDataType()) {
                'integer' => (is_numeric($fieldData)) ? (int) $fieldData : $fieldData,
                default => $fieldData
            };


            if(!$field->isValid($fieldData)) {
                return false;
            }
        }

        return true;
    }
}