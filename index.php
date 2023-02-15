<?php
require_once('helpers.php');
require_once ('templates/connect_DB.php');

$projects = getprojects($con);
$tasks = gettask($con);

$resultTasks = [
    'backlog' => [],
    'todo' => [],
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

$main_content = renderTemplate('main.php',
    [
        'tasks' => $resultTasks
    ]
);

$website = renderTemplate('layout.php',
    [
        'site_name' => 'Мой сайт',
        'username' => 'Savchenko',
        'content' => $main_content,
        'projects' => $projects,
    ]
);

print $website;



