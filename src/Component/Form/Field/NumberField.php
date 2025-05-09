<?php

declare(strict_types=1);

namespace Kapoot\Form\Field;

use Kapoot\Form\Validation\Min;
use Kapoot\Form\Validation\Max;

class NumberField extends AbstractField
{
    private readonly int $min;

    private readonly int $max;

    public function setMin(int $min) : self
    {
        $this->min = $min;

        $this->addValidation(Min::class);
        
        return $this;
    }

    public function getMin() : ?int
    {
        return $this->min;
    }

    public function setMax(int $max) : self
    {
        $this->max = $max;

        $this->addValidation(Max::class);

        return $this;
    }

    public function getMax() : ?int
    {
        return $this->max;
    }
}