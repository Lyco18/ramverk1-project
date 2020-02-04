<?php

namespace Anax\HTMLForm;
 
require __DIR__ . "/../incl/config.php";

$title = "Validate not empty";
$form = new FormModelValidateNotEmpty($di);
$form->check();

require __DIR__ . "/../incl/renderPage.php";
