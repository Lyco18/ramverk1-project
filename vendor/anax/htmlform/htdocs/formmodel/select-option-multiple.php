<?php

namespace Anax\HTMLForm;
 
require __DIR__ . "/../incl/config.php";

$title = "Select option with multiple choices";
$form = new FormModelSelectOptionMultiple($di);
$form->check();

require __DIR__ . "/../incl/renderPage.php";
