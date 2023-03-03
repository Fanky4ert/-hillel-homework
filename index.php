<?php

require_once('helpers.php');
$id_project = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$con = connect();
$projects = getProjects($con);
$result = true;
if ($id_project !== false && $id_project !== null) {
    $result = false;
    foreach ($projects as $project) {
        if ((int)$project['id'] === $id_project) {
            $result = true;
        }
    }
}

if ($id_project === false || $result === false) {
    header("HTTP/1.1 404 Not Found");
    die;
}

if ($id_project !== null) {
    $tasks = gettasks($con, $id_project);
    $resultTasks = [
        'backlog' => [],
        'to-do' => [],
        'in_progress' => [],
        'done' => [],
    ];
    foreach ($tasks as $task) {
        $status = $task['status'];
        $resultTasks[$status][] = [
            'id' => $task['id'],
            'title' => $task['header'],
            'description' => $task['description'],
            'due_date' => $task['end_time'],
        ];
    }
}

$main_content = '<div class="main-footer">' . ' Виберіть або створіть проект' . "</div>";

if ($id_project !== null) {
    $main_content = renderTemplate(
        'main.php',
        [
            'tasks' => $resultTasks,

        ]
    );
}



$website = renderTemplate(
    'layout.php',
    [
        'site_name' => 'Мой сайт',
        'username' => 'Savchenko',
        'content' => $main_content,
        'projects' => $projects,
        'id_project' => $id_project,
    ]
);
print $website;
