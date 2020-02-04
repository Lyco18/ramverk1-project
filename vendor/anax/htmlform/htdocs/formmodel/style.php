<?php

namespace Anax\HTMLForm;
 
require __DIR__ . "/../incl/config.php";

$title = "Style the form";
$form = new FormModelStyle($di);
$form->check();

require __DIR__ . "/../incl/renderPage.php";
