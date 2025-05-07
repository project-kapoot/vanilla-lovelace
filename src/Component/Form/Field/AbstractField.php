<?php

declare(strict_types=1);

namespace Kapoot\Form\Field;

use Exception;

use Kapoot\Form\Validation\FieldValidationInterface;
use Kapoot\Form\Validation\IsRequired;

abstract class AbstractField
{
    private array $validations = [];

    public function __construct(
        private readonly string $name,
        private readonly string $label,
        protected readonly mixed $value
    ){}

    abstract public function getDataType() : string;

    public function getLabel() : string
    {
        return $this->label;
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

    public function getName() : string
    {
        return $this->name;
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
}