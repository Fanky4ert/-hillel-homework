<?php

require_once('helpers.php');
$idProject = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$con = connect();
$projects = getProjects($con);
$result = true;
if ($idProject !== false && $idProject !== null) {
    $result = false;
    foreach ($projects as $project) {
        if ((int)$project['id'] === $idProject) {
            $result = true;
        }
    }
}

if ($idProject === false || $result === false) {
    header("HTTP/1.1 404 Not Found");
    die;
}

if ($idProject !== null) {
    $tasks = gettasks($con, $idProject);
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
            'dueDate' => $task['end_time'],
        ];
    }
}

$mainContent = '<div class="main-footer">' . ' Виберіть або створіть проект' . "</div>";

if ($idProject !== null) {
    $mainContent = renderTemplate(
        'main.php',
        [
            'tasks' => $resultTasks,

        ]
    );
}

$projectName = renderTemplate(
    'project_name.php',
    [
    'projects' => $projects,
    'idProject' => $idProject,
    'username' => 'Savchenko',
    ]
);

$website = renderTemplate(
    'layout.php',
    [
        'siteName' => 'Мой сайт',
        'content' => $mainContent,
        'projectName' => $projectName,
    ]
);
print $website;
