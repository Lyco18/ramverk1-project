<?php
include("../incl/config.php");

$title = "Multiple forms in one page";
$form = new \Anax\HTMLForm\FormModelSearchWidget();
$form->check();

include("../incl/renderPage.php");
