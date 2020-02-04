<?php

namespace Anax\HTMLForm;
 
require __DIR__ . "/../incl/config.php";

$title = "Search widget";
$form = new FormModelSearchWidget($di);
$form->check();

require __DIR__ . "/../incl/renderPage.php";
