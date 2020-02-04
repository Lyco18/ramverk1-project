<?php

namespace Anax\HTMLForm;
 
require __DIR__ . "/../incl/config.php";

$title = "Custom validation";
$form = new FormModelValidateCustom($di);
$form->check();

require __DIR__ . "/../incl/renderPage.php";
