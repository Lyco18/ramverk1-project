<?php

namespace Anax\HTMLForm;
 
require __DIR__ . "/../incl/config.php";

$title = "Using checkboxes";
$form = new FormModelCheckbox($di);
$res = $form->check();

require __DIR__ . "/../incl/renderPage.php";
