<?php

require_once('helpers.php');
$con = connect();
$projects = getProjects($con);
$errors = [];
$user_id = 1;
$link = ('index.php');
if (isset($_POST['btn-add'])) {
    $id_project = filter_input(INPUT_POST, 'selectProject', FILTER_VALIDATE_INT);

    if ($_POST['inputName'] === '') {
        $errors['inputName'] = 'Помилка імені';
    }
    if (strlen($_POST['inputName']) < 2 || strlen($_POST['inputName']) > 50) {
        $errors['inputName'] = 'Помилка формату імені';
    }
    if (strlen($_POST['inputDescription']) > 100) {
        $errors['inputDescription'] = 'Помилка, не більше 100 символів';
    }
    $dateValid = isDateValid($_POST['inputDate']); //bool
    $dateCalc = obsoluttime($_POST['inputDate']); // количество часов

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
            $_POST['inputName'],
            $_POST['inputDescription'],
            $_POST['inputDate'],
            $user_id,
            $id_project
        );
        if ($insertDB === true) {
            header("Location: index.php");
        }
    }
}
print renderTemplate('task-add.php', [
    'errors' => $errors,
    'projects' => $projects,
]);
