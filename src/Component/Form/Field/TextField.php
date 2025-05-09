<?php

declare(strict_types=1);

namespace Kapoot\Form\Field;

use Kapoot\Form\Validation\MaxLength;
use Kapoot\Form\Validation\MinLength;

class TextField extends AbstractField
{
    private readonly int $minLength;

    private readonly int $maxLength;

    public function setMinLength(int $minLength) : self
    {
        if($minLength < 0) {
            throw new \InvalidArgumentException('Argument must not be less than 0');
        }

        $this->minLength = $minLength;

        $this->addValidation(MinLength::class);

        return $this;
    }

    public function getMinLength() : ?int 
    {
        return $this->minLength;
    }

    public function setMaxLength(int $maxLength) : self
    {
        if($maxLength <= 0) {
            throw new \InvalidArgumentException('Argument must not be less than or equal to 0');
        }

        $this->maxLength = $maxLength;

        $this->addValidation(MaxLength::class);

        return $this;
    }

    public function getMaxLength() : ?int
    {
        return $this->maxLength;
    }
}