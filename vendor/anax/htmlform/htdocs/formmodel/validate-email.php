<?php

namespace Anax\HTMLForm;
 
require __DIR__ . "/../incl/config.php";

$title = "Validate email";
$form = new FormModelValidateMail($di);
$form->check();

require __DIR__ . "/../incl/renderPage.php";
