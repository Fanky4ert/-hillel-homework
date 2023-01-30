<?php
include_once ('templates/helpers.php');
$arr = [
    'headsite'=>'школа php',
    'savchenko'=>'Савченко',
];
extract($arr);

$project = renderTemplate('project.php');
$down = renderTemplate('footer.php');
$card = renderTemplate('card1.php');
$vstavka = renderTemplate('main.php',['card1'=>$card]);

$website = renderTemplate('layout.php',['content'=>$vstavka,'project'=>$project,'sitename'=>$headsite,'soname'=>$savchenko,'footer'=>$down]);

print $website;

?>

