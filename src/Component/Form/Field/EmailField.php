<?php

namespace Kapoot\Form\Field;

use Kapoot\Form\Validation\IsEmail;

class EmailField extends TextField
{
    public function __construct(string $name, string $label, mixed $value)
    {
        parent::__construct($name, $label, $value);

        $this->addValidation(IsEmail::class);
    }
}