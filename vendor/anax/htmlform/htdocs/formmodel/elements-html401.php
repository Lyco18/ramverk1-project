<?php

namespace Anax\HTMLForm;
 
require __DIR__ . "/../incl/config.php";

$title = "Form elements as of HTML 4.01";
$form = new FormModelElementsHTML401($di);
$form->check();

require __DIR__ . "/../incl/renderPage.php";
