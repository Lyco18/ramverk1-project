<?php

namespace Anax\HTMLForm;
 
require __DIR__ . "/../incl/config.php";

$title = "Checkbox with multiple choices";
$form = new FormModelCheckboxMultiple($di);
$form->check();

require __DIR__ . "/../incl/renderPage.php";
