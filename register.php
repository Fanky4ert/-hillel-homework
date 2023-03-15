<?php
require_once('helpers.php');
$con = connect();
$errors = [];

$formData = [
    'name-register' => '',
    'email-register' => '',
    'password1' => '',
    'password2' => '',
    'terms-check' => '',
];
if (isset($_POST['btn-add-reg'])) {
    $formData = [
        'name-register' => filter_var(trim($_POST['name-register']), FILTER_SANITIZE_STRING),
        'email-register' => filter_var(trim($_POST['email-register']), FILTER_SANITIZE_STRING),
        'password1' => filter_var(trim($_POST['password1']), FILTER_SANITIZE_STRING),
        'password2' => filter_var(trim($_POST['password2']), FILTER_SANITIZE_STRING),
        'terms-check' => key_exists("terms-check",$_POST),
    ];
    if ($formData['name-register'] === '') {
        $errors['name-register'] = 'Помилка імені';
    }
    if (strlen($formData['name-register']) < 1 || strlen($formData['name-register']) > 25) {
        $errors['inputName'] = 'Помилка формату імені';
    }
    if ($formData['email-register'] === false) {
        $errors['email-register'] = 'Помилка формату "Email"';
    }
    if (checkEmail($con, $formData['email-register']) === false){
        $errors['email-register'] = 'Помилка, такий Email вже зареестрований';
    }
    if (strlen($formData['email-register']) > 35) {
        $errors['email-register'] = 'Помилка, не більше 35 символів';
    }
    if ($formData['password1'] === '') {
        $errors['password1'] = 'Помилка пароля';
    }
    if ($formData['password2'] === '') {
        $errors['password2'] = 'Помилка повтору пароля';
    }
    if ($formData['password1'] !== $formData['password2']) {
        $errors['password2'] = 'Помилка, паролі не співпадають';
    }
    if (strlen($formData['password1']) > 35 || strlen($formData['password2']) > 35) {
        $errors['password2'] = 'Помилка, не більше 35 символів';
    }

    if ($formData['terms-check'] === false) {
        $errors['terms-check'] = 'Помилка, треба погодитись з умовами';
    }
    if (empty($errors)) {
        $insertDB = createusertoDB(
            $con,
            date('Y-m-d H:i:s'),
            $formData['email-register'],
            $formData['name-register'],
            $formData['password1']
        );
        if ($insertDB = true) {
            header('Location: index.php');
        }
    }
}

print renderTemplate('register-add.php',
    [
        'errors' => $errors,
        'formData' => $formData,
    ]
);
