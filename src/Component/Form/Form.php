<?php

declare(strict_types=1);

namespace App\Component\Form;

use App\Component\Form\Field\AbstractField;

class Form 
{
    public function __construct(
        private readonly string $prefix,
        private readonly array $fields,
    ){}

    public function getField(string $name) : ?AbstractField
    {
        return $this->fields[$name] ?? null;
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

        foreach($this->fields as $field)
        {
            $fieldData = $formData[$field->getName()] ?? null;

            if(!$field->isValid($fieldData)) {
                return false;
            }
        }

        return true;
    }
}