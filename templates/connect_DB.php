<?php

mysqli_report(MYSQLI_REPORT_ERROR);
$con = mysqli_connect("localhost", "root", "", "hillel_homework");
if ($con === false) {
    die('Не могу подключится к БД');
}
echo 'Соединение установлено';
mysqli_set_charset($con, 'UTF8');



