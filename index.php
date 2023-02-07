<?php
require_once('helpers.php');

$projects = [
  [
    'id'=>'1',
    'name' => 'Проект 1',
    'count' => 2,
  ],
  [
    'id' => 2,
    'name' => 'Проект 2',
    'count' => 5,
  ],
];

$tasks = [
  'becklog' => [
    [
      'id' => 1,
      'title' => 'Задача 1',
      'description' => 'Описание задачи 1',
      'due_date' => '2023-02-05',
    ],
    [
      'id' => 2,
      'title' => 'Задача 2',
      'description' => 'Описание задачи 2',
      'due_date' => '2023-02-10',
    ],
  ],
  'todo' => [],
  'in_progress' => [
      [
     'id' => 3,
     'title' => 'Задача 3',
     'description' => 'Описание задачи 3',
     'due_date' => 'tomorrow',
      ],
   ],
  'done' => [
      [
          'id' => 4,
          'title' => 'Задача 4',
          'description' => 'Описание задачи 4',
          'due_date' => ''
      ],
  ],
];

$main_content = renderTemplate('main.php',
  [
    'tasks' => $tasks
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



