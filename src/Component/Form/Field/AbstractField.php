<?php

declare(strict_types=1);

namespace Kapoot\Form\Field;

use Exception;
use Kapoot\Form\AbstractForm;
use Kapoot\Form\Validation\FieldValidationInterface;
use Kapoot\Form\Validation\IsRequired;

abstract class AbstractField
{
    private array $validations = [];

    private readonly string $name;

    private readonly string $label;

    protected readonly mixed $value;

    public function __construct(string $name, string $label, mixed $value = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
    }

    abstract public function getDataType() : string;

    public function getName() : string
    {
        return $this->name;
    }
    
    public function getPrefixedName(AbstractForm $form) : string
    {
        return sprintf('%s[%s]', $form->getName(), $this->getName());
    }

    public function getLabel() : string
    {
        return $this->label;
    }
    
    public function getValue() : mixed
    {
        return $this->value;
    }

    public function addValidation(FieldValidationInterface $validation) : static
    {
        if($this->hasValidation($validation::class)) {
            throw new \Exception();
        }

        $this->validations[$validation::class] = $validation;

        return $this;
    } 

    public function hasValidation(string $validationFqcn) : bool
    {
        return isset($this->validations[$validationFqcn]);
    }


    public function getValidation(string $validationFqcn) : FieldValidationInterface
    {
        return $this->validations[$validationFqcn];
    }

    public function getValidations() : array
    {
        return $this->validations;
    }

    public function setRequired() : static
    {
        $this->addValidation(new IsRequired());

        return $this;
    }
    
    public function isRequired() : bool
    {
        return $this->hasValidation(IsRequired::class);
    }

    public function validate(mixed $formData) : array
    {
        $fieldData = $formData[$this->getName()] ?? null;

        $fieldData = match($this->getDataType()) {
            'integer' => (is_numeric($fieldData)) ? (int) $fieldData : $fieldData,
            default => $fieldData
        };

        if($this->isRequired()) {
            $validation = $this->getValidation(IsRequired::class);

            if(!$validation->isValid($this, $fieldData)) {
                return [false, $validation->getError($this, $fieldData)];
            }
        }

        foreach($this->getValidations() as $validation)
        {
            if($validation->isValid($this, $fieldData)) continue;

            $error = $validation->getError($this, $fieldData);
            
            return [false, $error];
        }

        return [true, null];
    }
}