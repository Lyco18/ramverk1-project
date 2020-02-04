<?php

namespace Anax\HTMLForm;
 
require __DIR__ . "/../incl/config.php";

$title = "Password matches, validate using 'match'";
$form = new FormModelValidateMatch($di);
$form->check();

require __DIR__ . "/../incl/renderPage.php";
