<?php

namespace Anax\HTMLForm;
 
require __DIR__ . "/../incl/config.php";

$title = "Form elements HTML 4.01 and HTML5";
$form = new FormModelElementsAll($di);
$form->check();

require __DIR__ . "/../incl/renderPage.php";
