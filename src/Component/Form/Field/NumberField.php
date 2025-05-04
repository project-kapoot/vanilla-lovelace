<?php

declare(strict_types=1);

namespace Kapoot\Form\Field;

use Kapoot\Form\Validation\Min;
use Kapoot\Form\Validation\Max;

class NumberField extends AbstractField
{
    public function setMin(int $value) : self
    {
        $this->addValidation(new Min($value));
        
        return $this;
    }

    public function getMin() : ?int
    {
        return $this->hasValidation(Min::class) ? $this->getValidation(Min::class)->getMin() : null;
    }

    public function setMax(int $value) : self
    {
        $this->addValidation(new Max($value));

        return $this;
    }

    public function getMax() : ?int
    {
        return $this->hasValidation(Max::class) ? $this->getValidation(Max::class)->getMax() : null;
    }

    public function getDataType(): string
    {
        return 'integer';
    }
}