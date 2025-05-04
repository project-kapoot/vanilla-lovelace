<?php

use Kapoot\Form\FieldValidator;
use Kapoot\Form\FormValidator;
use App\Form\ContactForm;

$formValidator = new FormValidator($_POST, new FieldValidator());

$fakeData = ['name' => 'test', 'city' => 'paris', 'age' => 20];
$form = new ContactForm('contact_form', $fakeData);

[$isSubmitted, $isValid, $errors] = $formValidator->validate($form);

if($isSubmitted && $isValid) {
    // Do something
}

$error = $errors[0] ?? null;