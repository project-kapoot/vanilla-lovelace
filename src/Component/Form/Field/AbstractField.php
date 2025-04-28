<?php

declare(strict_types=1);

namespace App\Component\Form\Field;

abstract class AbstractField
{
    private bool $isRequired = false;

    public function __construct(
        private readonly string $name,
        private readonly string $label,
    ){}

    abstract public function getDataType() : string;

    public function isValid(string|int|array|bool|null $fieldData) : bool
    {
        if(!$this->isRequired() && null === $fieldData) {
            return true;
        }

        return false;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getLabel() : string
    {
        return $this->label;
    }

    public function setRequired() : self
    {
        $this->isRequired = true;

        return $this;
    }

    public function isRequired() : bool
    {
        return $this->isRequired;
    }
}