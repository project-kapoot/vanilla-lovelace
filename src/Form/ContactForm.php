<?php

namespace App\Form;

use Kapoot\Form\AbstractForm;
use Kapoot\Form\Field\ChoiceField;
use Kapoot\Form\Field\NumberField;
use Kapoot\Form\Field\TextField;
use Kapoot\Form\FieldCollection;

class ContactForm extends AbstractForm
{
    protected function configureFields(FieldCollection $fields, array|object $data) : FieldCollection
    {
        $fields[] = (new TextField('name', 'Nom', $data['name']))
            ->setMinLength(5);

        $fields[] = (new ChoiceField('city', 'Ville', $data['city'] ?? null))
            ->setChoices(['paris', 'doubai'])
            ->setRequired();

        $fields[] = (new NumberField('age', 'Age', $data['age']))
            ->setRequired()
            ->setMin(0)
            ->setMax(120);

        return $fields;
    }
}