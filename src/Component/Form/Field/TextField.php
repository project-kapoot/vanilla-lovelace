<?php

declare(strict_types=1);

namespace App\Component\Form\Field;

use InvalidArgumentException;

class TextField extends AbstractField
{
    private readonly int $minLength;
    private readonly int $maxLength;

    public function setMinLength(int $value) : self
    {
        if($value < 0) {
            throw new InvalidArgumentException('Argument must not be less than 0');
        }

        $this->minLength = $value;

        return $this;
    }

    public function setMaxLength(int $value) : self
    {
        if($value <= 0) {
            throw new InvalidArgumentException('Argument must not be less than or equal to 0');
        }

        $this->maxLength = $value;

        return $this;
    }

    public function getMinLength() : int 
    {
        return $this->minLength ?? 0;
    }

    public function getMaxLength() : int
    {
        return $this->maxLength ?? PHP_INT_MAX;
    }

    public function getDataType(): string
    {
        return 'string';
    }

    public function isValid(string|int|array $fieldData): bool
    {
        if(parent::isValid($fieldData)) {
            return true;
        }

        if(gettype($fieldData) !== 'string') {
            return false;
        }

        if(isset($this->minLength) && strlen($fieldData) < $this->minLength) {
            return false;
        }

        if(isset($this->maxLength) && strlen($fieldData) > $this->maxLength) {
            return false;
        }

        return true;
    }
}