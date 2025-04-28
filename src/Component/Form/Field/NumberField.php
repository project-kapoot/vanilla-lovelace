<?php

declare(strict_types=1);

namespace App\Component\Form\Field;

class NumberField extends AbstractField
{
    private readonly int $min;
    private readonly int $max;

    public function setMin(int $value) : self
    {
        $this->min = $value;

        return $this;
    }

    public function setMax(int $value) : self
    {
        $this->max = $value;

        return $this;
    }

    public function getMin() : int
    {
        return $this->min;
    }

    public function getMax() : int
    {
        return $this->max;
    }

    public function getDataType(): string
    {
        return 'integer';
    }

    public function isValid(string|int|array|bool|null $fieldData): bool
    {
        if(parent::isValid($fieldData)) {
            return true;
        }

        if(gettype($fieldData) !== 'integer') {
            return false;
        }

        if(isset($this->min) && $fieldData < $this->min) {
            return false;
        }

        if(isset($this->max) && $fieldData > $this->max) {
            return false;
        }

        return true;
    }
}