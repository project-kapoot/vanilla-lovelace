<?php

namespace App\Component\Form;

function form_widget(AbstractForm $form, string $fieldName, string $additionalHtml) : string
{
    $field = $form->getField($fieldName);

    return $field->renderWidget($additionalHtml);
}

function form_label(AbstractForm $form, string $fieldName, string $additionalHtml) : string
{
    $field = $form->getField($fieldName);

    return $field->renderLabel($additionalHtml);
}