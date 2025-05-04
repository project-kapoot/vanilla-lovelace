<?php

use App\Component\Form\FieldValidator;
use App\Component\Form\FormValidator;
use App\Form\ContactForm;

use function App\Component\Form\form_label;
use function App\Component\Form\form_widget;

$formValidator = new FormValidator($_POST, new FieldValidator());

$fakeData = ['name' => 'test', 'city' => 'paris', 'age' => 20];
$form = new ContactForm('contact_form', $fakeData);

[$isSubmitted, $isValid, $errors] = $formValidator->validate($form);

if($isSubmitted && $isValid) {
    // Do something
}

$error = $errors[0] ?? null;

$nameLabel = form_label($form, 'name', 'for="contact_form_name"');
$nameWidget = form_widget($form, 'name', 'id="contact_form_name"');
$cityWidget = form_widget($form, 'city', 'id="contact_form_city"');

echo <<<FORM
    <p>{$error}</p>
    <form method="post">
        {$nameLabel}
        {$nameWidget}
        <label>Ville</label>
        {$cityWidget}
        <label>Age</label>
        <input type="number" name="contact_form[age]" value="{$fakeData['age']}">
        <button type="submit">Envoyer</button>
    </form>
FORM;