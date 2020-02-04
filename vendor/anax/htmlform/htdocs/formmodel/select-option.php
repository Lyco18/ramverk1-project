<?php

namespace Anax\HTMLForm;
 
require __DIR__ . "/../incl/config.php";

$title = "Select option list";
$form = new FormModelSelectOption($di);
$form->check();

require __DIR__ . "/../incl/renderPage.php";
