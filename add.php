<?php

require_once('helpers.php');
require_once('classes/FirstClass.php');
$con = connect();
$projects = getProjects($con);
$errors = [];
$userId = 1;

$formData = [
    'inputName' => '',
    'inputDescription' => '',
    'inputDate' => '',
    'selectProject' => '',
];

if (isset($_POST['btn-add'])) {
    $idProject = filter_input(INPUT_POST, 'selectProject', FILTER_VALIDATE_INT);
    $formData = [
        'inputName' => $_POST['inputName'],
        'inputDescription' => $_POST['inputDescription'],
        'inputDate' => $_POST['inputDate'],
        'selectProject' => $_POST['selectProject'],
    ];
    if ($formData['inputName'] == '') {
        $errors['inputName'] = 'Помилка імені';
    }
    if (strlen($formData['inputName']) < 2 || strlen($formData['inputName']) > 50) {
        $errors['inputName'] = 'Помилка формату імені';
    }
    if (strlen($formData['inputDescription']) > 100) {
        $errors['inputDescription'] = 'Помилка, не більше 100 символів';
    }
    if (empty($formData['inputDate'])) {
        $formData['inputDate'] = null;
    }

    if (!empty($formData['inputDate'])) {
        $dateValid = isDateValid($formData['inputDate']); //bool
        $dateCalc = obsoluttime($formData['inputDate']); // количество часов

        if ($dateValid === false || $dateCalc <= 0) {
            $errors['inputDate'] = 'Помилка дати';
        }
    }

    $projects = getProjects($con);

    $projectValid = false;
    foreach ($projects as $project) {
        if ((int)$project['id'] === $idProject) {
            $projectValid = true;
        }
    }

    if ($projectValid === false) {
        $errors['selectProject'] = 'Помилка проекту';
    }

    if (empty($errors)) {
        if (isset($_FILES['inputTaskFile'])) {
            $fileName = $_FILES['inputTaskFile']['name'];
            $filePath = __DIR__ . '/uploads/' . $fileName;
            move_uploaded_file($_FILES['inputTaskFile']['tmp_name'], $filePath . $fileName);
        }
        $insertDb = insertTaskToDatabase(
            $con,
            date('Y-m-d H:i:s'),
            $formData['inputName'],
            $formData['inputDescription'],
            $formData['inputDate'],
            $userId,
            $idProject
        );

        if ($insertDb = true) {
            header('Location: index.php');
        }
    }
}

$projectName = renderTemplate(
    'project_name.php',
    [
        'projects' => $projects,
        'idProject' => $projects,
        'username' => 'Savchenko',

    ]
);

$taskAdd = renderTemplate(
    'task-add.php',
    [
        'errors' => $errors,
        'projects' => $projects,
        'formData' => $formData,
    ]
);

print renderTemplate(
    'layout.php',
    [
        'siteName' => 'Мой сайт',
        'content' => $taskAdd,
        'projectName' => $projectName,
    ]
);
