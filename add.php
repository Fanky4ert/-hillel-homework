<?php

require_once('helpers.php');
require_once('classes/FirstClass.php');
$con = connect();
$projects = getProjects($con);
$errors = [];
$user_id = 1;


//$formData = new FormData(
 //   $_POST['inputName'],
  //  $_POST['inputDescription'],
//    $_POST['inputDate'],
//    $_POST['selectProject']
//);
$formData = [
    'inputName' => '',
    'inputDescription' => '',
    'inputDate' => '',
    'selectProject' => '',
];


if (isset($_POST['btn-add'])) {
    $id_project = filter_input(INPUT_POST, 'selectProject', FILTER_VALIDATE_INT);
    $formData = [
        'inputName' => $_POST['inputName'],
        'inputDescription' => $_POST['inputDescription'],
        'inputDate' => $_POST['inputDate'],
        'selectProject' => $_POST['selectProject'],
    ];
    if ($formData['inputName'] === '') {
        $errors['inputName'] = 'Помилка імені';
    }
    if (strlen($formData['inputName']) < 2 || strlen($formData['inputName']) > 50) {
        $errors['inputName'] = 'Помилка формату імені';
    }
    if (strlen($formData['inputDescription']) > 100) {
        $errors['inputDescription'] = 'Помилка, не більше 100 символів';
    }
    $dateValid = isDateValid($formData['inputDate']); //bool
    $dateCalc = obsoluttime($formData['inputDate']); // количество часов

    if ($dateValid === false || $dateCalc <= 0) {
        $errors['inputDate'] = 'Помилка дати';
    }

    $projects = getProjects($con);

    $projectValid = false;
    foreach ($projects as $project) {
        if ((int)$project['id'] === $id_project) {
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
        $insertDB = insertTaskToDatabase(
            $con,
            date('Y-m-d H:i:s'),
            $formData['inputName'],
            $formData['inputDescription'],
            $formData['inputDate'],
            $user_id,
            $id_project
        );

        if ($insertDB = true) {
            header('Location: index.php');
        }
    }
}

//$valueName = filter_input(INPUT_POST, 'inputName');
//$valueDate = filter_input(INPUT_POST,'inputDate');

$project_name = renderTemplate(
    'project_name.php',
    [
        'projects' => $projects,
        'id_project' => $projects,
        'username' => 'Savchenko',

    ]
);

$task_add = renderTemplate(
    'task-add.php',
    [
        'errors' => $errors,
        'projects' => $projects,
       // 'valueName' => $valueName,
       // 'valueDate' => $valueDate,
        'formData' => $formData,
    ]
);

print renderTemplate(
    'layout.php',
    [
        'site_name' => 'Мой сайт',
        'content' => $task_add,
        'project_name' => $project_name,
    ]
);
