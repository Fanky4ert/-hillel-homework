<?php
include_once ('templates/helpers.php');


$project = renderTemplate('project.php');
$title = 'Назва сторінки';
$savchenko = 'Савченко';


$card = renderTemplate('card1.php');
$vstavka = renderTemplate('main.php',['card1'=>$card]);

$website = renderTemplate('layout.php',['content'=>$vstavka,'project'=>$project,'title'=>$title,'soname'=>$savchenko]);

print $website;

?>

