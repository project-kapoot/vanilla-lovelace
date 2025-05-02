<?php

declare(strict_types=1);

namespace App\Component\Form\Field;

use App\Component\Form\Validation\FieldValidationInterface;
use App\Component\Form\Validation\IsRequired;

abstract class AbstractField
{
    private bool $isRequired = false;

    private array $errors;

    private array $validations = [];

    public function __construct(
        private readonly string $name,
        private readonly string $label,
        private readonly mixed $data,
    ){}

    abstract public function getDataType() : string;

    public function addValidation(FieldValidationInterface $validation) : static
    {
        $this->validations[] = $validation;

        return $this;
    } 

    public function getValidations() : array
    {
        return $this->validations;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getLabel() : string
    {
        return $this->label;
    }

    public function setRequired() : static
    {
        $this->isRequired = true;

        $this->addValidation(new IsRequired());

        return $this;
    }

    public function isRequired() : bool
    {
        return $this->isRequired;
    }
}