# Form Component

The goal of this component is to provide a way to validate requests easely and to groups forms, validations ...

Use case exemple :

First, create a form by extending the AbstractForm class and define the `configureFields` method :
```php
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
        $fiels[] = (new TextField('name', 'Nom', $data['name']))
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
```

Once the form is defined in a class, you can use it like this :

```php
<?php

use App\Component\Form\FieldValidator;
use App\Component\Form\FormValidator;
use App\Form\ContactForm;

$formValidator = new FormValidator($_POST, new FieldValidator());

$fakeData = ['name' => 'test', 'city' => 'paris', 'age' => 20];
$form = new ContactForm('contact_form', $fakeData);

[$isSubmitted, $isValid, $errors] = $formValidator->validate($form);

if($isSubmitted && $isValid) {
    // Do something
}

$error = $errors[0] ?? null;

echo <<<FORM
    <p>{$error}</p>
    <form method="post">
        <label>Name</label>
        <input type="text" name="contact_form[name]" value="{$fakeData['name']}">
        <label>Ville</label>
        <select name="contact_form[city]" required>
            <option value="paris" selected>Paris</option>
            <option value="dubai">Dubai</option>
        </select>
        <label>Age</label>
        <input type="number" name="contact_form[age]" value="{$fakeData['age']}">
        <button type="submit">Envoyer</button>
    </form>
FORM;
```