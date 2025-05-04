<?php

declare(strict_types=1);

namespace App\Component\Form\Field;

use App\Component\Form\Validation\FieldValidationInterface;
use App\Component\Form\Validation\IsRequired;

abstract class AbstractField
{
    protected bool $isRequired = false;

    private array $validations = [];

    public function __construct(
        private readonly string $name,
        private readonly string $label,
        protected readonly mixed $value
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

    final public function renderLabel(string $optionalAttributes = '') : string
    {
        return sprintf('<label %s>%s</label>', $optionalAttributes, $this->label);
    }

    abstract public function renderWidget(string $optionalAttributes = '') : string;

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