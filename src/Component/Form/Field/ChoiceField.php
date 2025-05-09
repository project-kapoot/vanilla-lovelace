<?php

declare(strict_types=1);

namespace Kapoot\Form\Field;

use Kapoot\Form\Validation\InArray;

class ChoiceField extends AbstractField
{
    private readonly array $choices;

    public function setChoices(array $choices) : self
    {
        $this->choices = $choices;

        $this->addValidation(InArray::class);

        return $this;
    }

    public function getChoices() : array
    {
        return $this->choices ?? [];
    }
}