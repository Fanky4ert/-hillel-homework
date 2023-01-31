<?php
require_once('helpers.php');

$project_side = renderTemplate('project.php');
$kanban_kard = renderTemplate('kanban_kard.php');




$main_content = renderTemplate('main.php',
  [
    'becklog_card' => $kanban_kard,
    'todo_card' => $kanban_kard,
    'inprogress_card' => $kanban_kard,
    'done_card' => $kanban_kard,

  ]
);


$website = renderTemplate('layout.php',
    [
        'site_name' => 'мой сайт',
        'username' => 'Savchenko',
        'content' => $main_content,
    ]
);

print $website;

?>

