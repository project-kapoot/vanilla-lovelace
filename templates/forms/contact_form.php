<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="">Name</label>
        <input type="text" name="<?= $form->getField('name')->getPrefixedName($form) ?>" value="<?= $form->getField('name')->getValue() ?>">
        <label for="">Ville</label>
        <select name="<?= $form->getField('city')->getPrefixedName($form) ?>" id="">
            <?php foreach($form->getField('city')->getChoices() as $choice) : ?>
                <option value="<?= $choice ?>"><?= $choice ?></option>
            <?php endforeach ?>
        </select>
        <label for="">Age</label>
        <input type="number" name="<?= $form->getField('age')->getPrefixedName($form) ?>" id="">
        <button type="submit">Valider</button>
    </form>
</body>
</html>