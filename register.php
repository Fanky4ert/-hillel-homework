<?php

require_once('helpers.php');
$con = connect();
$errors = [];

if (isset($_POST['btn-add-reg'])) {
    if ($_POST['name-register'] === '') {
        $errors['name-register'] = 'Помилка імені';
    }
    if (strlen($_POST['name-register']) < 1 || strlen($_POST['name-register']) > 25) {
        $errors['inputName'] = 'Помилка формату імені';
    }
    if ($_POST['email-register'] === false) {
        $errors['email-register'] = 'Помилка формату "Email"';
    }
    if (strlen($_POST['email-register']) > 35) {
        $errors['email-register'] = 'Помилка, не більше 35 символів';
    }
    if ($_POST['password1'] === '') {
        $errors['password1'] = 'Помилка пароля';
    }
    if ($_POST['password2'] === '') {
        $errors['password2'] = 'Помилка повтору пароля';
    }
    if ($_POST['password1'] !== $_POST['password2']) {
        $errors['password2'] = 'Помилка, паролі не співпадають';
    }
    if (strlen($_POST['password1']) > 50 || strlen($_POST['password2']) > 50) {
        $errors['password2'] = 'Помилка, не більше 35 символів';
    }
    if ($_POST['terms-check'] !== 'agree') {
        $errors['terms-check'] = 'Помилка, треба погодитись з умовами';
    }
    if (empty($errors)) {
        $insertDB = createusertoDB(
            $con,
            date('Y-m-d H:i:s'),
            $_POST['email-register'],
            $_POST['name-register'],
            $_POST['password1'],
        );
        if ($insertDB = true) {
            header('Location: index.php');
        }
    }
}

print renderTemplate('register-add.php');
