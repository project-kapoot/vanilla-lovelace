<?php

declare(strict_types=1);

namespace Kapoot\Form\Field;

use Kapoot\Form\Validation\MaxLength;
use Kapoot\Form\Validation\MinLength;

class TextField extends AbstractField
{
    public function setMinLength(int $value) : self
    {
        if($value < 0) {
            throw new \InvalidArgumentException('Argument must not be less than 0');
        }

        $this->addValidation(new MinLength($value));

        return $this;
    }

    public function getMinLength() : ?int 
    {
        return $this->hasValidation(MinLength::class) ? $this->getValidation(MinLength::class)->getMinLength() : null;
    }

    public function setMaxLength(int $value) : self
    {
        if($value <= 0) {
            throw new \InvalidArgumentException('Argument must not be less than or equal to 0');
        }

        $this->addValidation(new MaxLength($value));

        return $this;
    }

    public function getMaxLength() : ?int
    {
        return $this->hasValidation(MaxLength::class) ? $this->getValidation(MaxLength::class)->getMaxLength() : null;
    }

    public function getDataType(): string
    {
        return 'string';
    }
}