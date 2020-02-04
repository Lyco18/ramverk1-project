<?php

namespace Anax\HTMLForm;
 
require __DIR__ . "/../incl/config.php";

$title = "Login";
$form = new FormModelLogin($di);
$form->check();

require __DIR__ . "/../incl/renderPage.php";
