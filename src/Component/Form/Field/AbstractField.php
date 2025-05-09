<?php

declare(strict_types=1);

namespace Kapoot\Form\Field;

use Kapoot\Form\AbstractForm;
use Kapoot\Form\Validation\AbstractValidation;
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

    final public function addValidation(AbstractValidation $validation) : static
    {
        $allowedFieldFqcn = $validation::ALLOWED_FIELD_FQCN;

        if(!($this instanceof $allowedFieldFqcn)) {
            throw new \InvalidArgumentException('Validation : "' . $validation::class . '" can only be added to instances of ' . $allowedFieldFqcn . '. See ' . $validation::class . '::getAllowedFieldFqcn() for more info on that.');
        }

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


    public function getValidation(string $validationFqcn) : AbstractValidation
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

        if($this->isRequired()) {
            $validation = $this->getValidation(IsRequired::class);

            var_dump($validation);

            [$isValid, $error] = $validation->validate($this, $fieldData);

            if(!$isValid) {
                return [$isValid, $error];
            }
        }

        foreach($this->getValidations() as $validation)
        {
            [$isValid, $error] = $validation->validate($this, $fieldData);

            if(!$isValid) {
                return [$isValid, $error];
            }
        }

        return [true, null];
    }
}