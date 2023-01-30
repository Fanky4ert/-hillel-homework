<?php
include_once ('templates/helpers.php');

$project = renderTemplate('project.php');
$down = renderTemplate('footer.php');
$card = renderTemplate('card1.php');
$vstavka = renderTemplate('main.php',['card1'=>$card]);

$website = renderTemplate('layout.php',['content'=>$vstavka,'sitename'=>'мой сайт','soname'=>'Savchenko','project'=>$project,'footer'=>$down]);

print $website;

?>

