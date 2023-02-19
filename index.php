<?php
require_once('helpers.php');

$id = filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT);
$con = connect();
$projects = getprojects($con);


$result = true;
if ($id !== false && $id !== null){
    $result = false;
foreach ($projects as $project){
     if ((int)$project['id'] === $id){
         $result = true;
     }
   }
}

if ($id === false || $result === false){
    header("HTTP/1.1 404 Not Found");
    die;
}
$id_project = $id;



if ($id_project !== null) {

    $tasks = gettasks($con, $id);
    $resultTasks = [
        'backlog' => [],
        'to-do' => [],
        'in_progress' => [],
        'done' => [],
    ];
    foreach ($tasks as $task){
        $status = $task['status'];

        $resultTasks[$status][] = [
            'id' => $task['id'],
            'title' => $task['header'],
            'description' => $task['description'],
            'due_date' => $task['end_time'],
        ];
    }
}



$main_content = renderTemplate('main.php',
    [
        'tasks' => $resultTasks
    ]
);

if ($id === null) {
    $main_content = '<div class="main-footer">' . ' Виберіть або створіть проект' . "</div>";

}

$website = renderTemplate('layout.php',
    [
        'site_name' => 'Мой сайт',
        'username' => 'Savchenko',
        'content' => $main_content,
        'projects' => $projects,
    ]
);

print $website;



