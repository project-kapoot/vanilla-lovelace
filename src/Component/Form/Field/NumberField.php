<?php

declare(strict_types=1);

namespace App\Component\Form\Field;

use App\Component\Form\Validation\Min;
use App\Component\Form\Validation\Max;

class NumberField extends AbstractField
{
    private readonly int $min;
    private readonly int $max;

    public function setMin(int $value) : self
    {
        $this->min = $value;

        $this->addValidation(new Min($value));
        
        return $this;
    }

    public function setMax(int $value) : self
    {
        $this->max = $value;

        $this->addValidation(new Max($value));

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
}