<?php

declare(strict_types=1);

namespace App\Component\Form;

use App\Component\Form\Field\AbstractField;

abstract class AbstractForm
{
    protected readonly string $name;
    protected readonly FieldCollection $fields;

    public function __construct(string $name, array|object $data)
    {
        $this->name = $name;
        $this->fields = $this->configureFields(new FieldCollection(), $data);
    }

    abstract protected function configureFields(FieldCollection $fields, array|object $data) : FieldCollection;

    public function getName() : string
    {
        return $this->name;
    }

    public function getFields() : FieldCollection
    {
        return $this->fields;
    }

    public function getField(string $name) : AbstractField
    {
        return $this->fields->get($name);
    }
}