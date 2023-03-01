<?php

require_once('helpers.php');
$con = connect();
$projects = getProjects($con);
$errors = [];
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
        $errors['inputDate'] = 'Помилка дата';
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
        $header = mysqli_real_escape_string($con, $_POST['inputName']);
        $end_time = mysqli_real_escape_string($con, $_POST['inputDate']);
        $project_id = mysqli_real_escape_string($con, $id_project);
        $description = mysqli_real_escape_string($con, $_POST['inputDescription']);
        $created_at = date("Y-m-d H:i:s");
        $user_id = mysqli_real_escape_string($con, (int)1);
        $sql = "INSERT INTO tasks (header, end_time, project_id, description, created_at, user_id) VALUES = (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'ssissi', $header, $end_time, $project_id, $description, $created_at, $user_id);
        $result = mysqli_stmt_execute($stmt);
        if ($result === true) {
            header("Location:index.php");
            exit;
        }
    }
}

print renderTemplate('task-add.php', [
    'errors' => $errors,
    'projects' => $projects,
]);
