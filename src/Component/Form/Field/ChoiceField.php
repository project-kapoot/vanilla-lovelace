<?php

declare(strict_types=1);

namespace App\Component\Form\Field;

class ChoiceField extends AbstractField
{
    private readonly array $choices;

    public function setChoices(array $choices) : self
    {
        $this->choices = $choices;

        return $this;
    }

    public function getChoices() : array
    {
        return $this->choices ?? [];
    }

    public function getDataType(): string
    {
        return 'string';
    }

    public function isValid(string|int|array $fieldData): bool
    {
        if(parent::isValid($fieldData)) {
            return true;
        }

        if(gettype($fieldData) !== $this->getDataType()) {
            return false;
        }        

        if(!in_array($fieldData, $this->choices)) {
            return false;
        }

        return true;
    }
}