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
$allTags = isset($allTags) ? $allTags : null;

?><h1>View Posts with tags</h1>

<?php foreach ($allTags as $tag) : ?>
    <h3><?= $tag->title; ?> </h3>
    <p><?= $tag->text; ?> </p>
    <p>Tags: <?= $tag->tag; ?> </p>
<?php endforeach; ?>
<br><a href="<?= url("tag") ?>" class="button">Show all tags</a>
