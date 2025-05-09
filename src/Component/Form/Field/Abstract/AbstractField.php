<?php

declare(strict_types=1);

namespace Kapoot\Form\Field\Abstract;

use Kapoot\Form\Abstract\AbstractForm;
use Kapoot\Form\Validation\Abstract\AbstractValidation;
use Kapoot\Form\Validation\IsRequired;
use ReflectionClass;

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

    final public function addValidation(string $validationFqcn) : static
    {
        if(!is_subclass_of($validationFqcn, AbstractValidation::class, true)) {
            throw new \InvalidArgumentException('Argument #1 must be a subclass of ' . AbstractValidation::class);
        }

        $allowedFieldFqcn = $validationFqcn::ALLOWED_FIELD_FQCN;

        if(!($this instanceof $allowedFieldFqcn)) {
            throw new \InvalidArgumentException('Argument #1 (' . $validationFqcn . ') can only be added to instances of ' . $allowedFieldFqcn . '. See ' . $validationFqcn . '::getAllowedFieldFqcn() for more info on that.');
        }

        if($this->hasValidation($validationFqcn)) {
            throw new \Exception('Cannot add the same validation multiple times.');
        }

        $reflection = new ReflectionClass($validationFqcn);

        if($reflection->isAbstract() || $reflection->isInterface() || $reflection->isTrait()) {
            throw new \InvalidArgumentException('Argument #1 must be a FQCN of a concrete implementation of ' . AbstractValidation::class);
        }

        $this->validations[$validationFqcn] = $validationFqcn;

        return $this;
    } 

    public function hasValidation(string $validationFqcn) : bool
    {
        return isset($this->validations[$validationFqcn]);
    }


    public function getValidation(string $validationFqcn) : string
    {
        return $this->validations[$validationFqcn];
    }

    public function getValidations() : array
    {
        return $this->validations;
    }

    public function setRequired() : static
    {
        $this->addValidation(IsRequired::class);

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

            [$isValid, $error] = $validation::validate($this, $fieldData);

            if(!$isValid) {
                return [$isValid, $error];
            }
        }

        foreach($this->getValidations() as $validation)
        {
            [$isValid, $error] = $validation::validate($this, $fieldData);

            if(!$isValid) {
                return [$isValid, $error];
            }
        }

        return [true, null];
    }
}