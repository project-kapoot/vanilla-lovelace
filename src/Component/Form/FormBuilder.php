<?php

declare(strict_types=1);

namespace App\Component\Form;

use App\Component\Form\Field\AbstractField;
use Exception;

class FormBuilder
{
    private array $fields = [];

    public function __construct(
        private readonly string $name,
    ){}
    
    public function addField(string $type, string $name, string $label) : AbstractField
    {
        if(!class_exists($type)) {
            throw new Exception();
        }

        if(!is_a($type, AbstractField::class, true)) {
            throw new Exception();
        }

        $field = new $type($name, $label);

        $this->fields[] = $field;

        return $field;
    }

    public function build() : Form
    {
        return new Form($this->name, $this->fields);
    }
}