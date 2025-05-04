<?php

declare(strict_types=1);

namespace Kapoot\Form\Field;

use Kapoot\Form\Validation\InArray;

class ChoiceField extends AbstractField
{
    public function setChoices(array $choices) : self
    {
        $this->addValidation(new InArray($choices));

        return $this;
    }

    public function getChoices() : array
    {
        return $this->hasValidation(InArray::class) ? $this->getValidation(InArray::class)->getChoices() : [];
    }

    public function getDataType(): string
    {
        return 'string';
    }
}