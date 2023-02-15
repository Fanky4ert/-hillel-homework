<?php
require_once('helpers.php');

$con = mysqli_connect("localhost", "root", "", "hillel_homework");
if ($con === false) {
    die('Не могу подключится к БД');
}
echo 'Соединение установлено';

mysqli_report(MYSQLI_REPORT_ERROR);
mysqli_set_charset($con, 'UTF8');


$projects = getprojects($con);
$tasks = gettasks($con);

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



