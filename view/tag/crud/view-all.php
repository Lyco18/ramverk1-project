<?php

namespace Anax\View;

/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$tags = isset($tags) ? $tags : null;

// Create urls for navigation
$urlToCreate = url("tag/create");



?><h1>Posts by tags</h1>

<?php if (!$tags) : ?>
    <p>There are no tags to show.</p>
<?php
    return;
endif;
// var_dump($tags);
?>
<h3>tags:</h3>
<?php foreach ($tags as $tag) :
    $array[] = $tag->tag;
endforeach;
$tagArray = array_unique($array);

foreach ($tagArray as $tag) : ?>
    <a href="<?= url("tag/view/{$tag}"); ?>" class="button"><?= $tag ?></a>

<?php endforeach; ?>
