<?php

namespace App\Form;

use App\Component\Form\AbstractForm;
use App\Component\Form\Field\ChoiceField;
use App\Component\Form\Field\NumberField;
use App\Component\Form\Field\TextField;
use App\Component\Form\FieldCollection;

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