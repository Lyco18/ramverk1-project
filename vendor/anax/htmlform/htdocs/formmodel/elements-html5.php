<?php

namespace Anax\HTMLForm;
 
require __DIR__ . "/../incl/config.php";

$title = "Form elements in HTML 5";
$form = new FormModelElementsHTML5($di);
$form->check();

require __DIR__ . "/../incl/renderPage.php";
