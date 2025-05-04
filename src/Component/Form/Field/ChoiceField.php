<?php

declare(strict_types=1);

namespace App\Component\Form\Field;

use App\Component\Form\AbstractForm;
use App\Component\Form\Validation\InArray;
use App\Component\Form\Validation\IsRequired;
use Override;

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

    public function renderWidget(string $optionalAttributes = ''): string
    {
        $requiredAttr = $this->isRequired ? 'required' : '';

        $html = sprintf('<select %s %s>', $optionalAttributes, $requiredAttr);

        foreach($this->choices as $choice)
        {
            $html .= sprintf('<option value="%s">%s</option>', $choice, ucfirst($choice));
        }

        $html .= '</select>';

        return $html;
    }
}