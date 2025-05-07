<?php

use Kapoot\Form\FormValidator;
use App\Form\ContactForm;

$formValidator = new FormValidator($_POST);

$fakeData = ['name' => 'test', 'city' => 'paris', 'age' => 20];
$form = new ContactForm('contact_form', $fakeData);

[$isSubmitted, $isValid, $error] = $formValidator->validate($form);

if($isSubmitted && $isValid) {
    // Do something
}

var_dump('Data', $_POST);
var_dump('Is submitted : ', $isSubmitted);
var_dump('Is validated : ', $isValid);
var_dump('Error : ', $error);

require_once __DIR__ . '/../templates/forms/contact_form.php';