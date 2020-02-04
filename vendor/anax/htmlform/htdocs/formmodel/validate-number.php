<?php

namespace Anax\HTMLForm;
 
require __DIR__ . "/../incl/config.php";

$title = "Validate number";
$form = new FormModelValidateNumber($di);
$form->check();

require __DIR__ . "/../incl/renderPage.php";
