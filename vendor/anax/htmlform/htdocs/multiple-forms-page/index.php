<?php
include("../incl/config.php");

$title = "Multiple forms in one page";
$form1 = new \Anax\HTMLForm\FormModelCheckboxMultiple();
$form2 = new \Anax\HTMLForm\FormModelSearchWidget();

$form1->check();
$form2->check();

?><!doctype html>
<meta charset=utf8>
<title><?= $title ?></title>
<h1><?= $title ?></h1>
<?=$form1->getHTML()?>
<?=$form2->getHTML()?>
