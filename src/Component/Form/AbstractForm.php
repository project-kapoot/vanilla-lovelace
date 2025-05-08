<?php

declare(strict_types=1);

namespace Kapoot\Form;

use Kapoot\Form\Field\AbstractField;
use Kapoot\Form\Validation\IsRequired;

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

    public function validate(array $requestData) : array
    {
        $isSubmitted = false;
        $isValid = false;
        $error = null;

        if(!$this->isSubmitted($requestData)) {
            return [$isSubmitted, $isValid, $error];
        }

        $isSubmitted = true;

        $formData = $requestData[$this->getName()];
        
        foreach($this->getFields() as $field)
        {
            [$isValid, $error] = $field->validate($formData);

            if(!$isValid && null !== $error) {
                return [$isSubmitted, $isValid, $error];
            }
        }

        $isValid = true;

        return [$isSubmitted, $isValid, $error];
    }
    
    private function isSubmitted(array $requestData) : bool
    {
        $formData = $requestData[$this->getName()] ?? null;

        return null !== $formData;
    }
}