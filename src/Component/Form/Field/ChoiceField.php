<?php

declare(strict_types=1);

namespace App\Component\Form\Field;

use App\Component\Form\Validation\InArray;

class ChoiceField extends AbstractField
{
    private readonly array $choices;

    public function setChoices(array $choices) : self
    {
        $this->choices = $choices;

        $this->addValidation(new InArray($choices));

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
}