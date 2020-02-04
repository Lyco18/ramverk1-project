<?php

namespace Anax\View;

/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$tag = isset($tag) ? $tag : null;
$post = isset($post) ? $post : null;
?>

<h1>Get to know the Gold Coast</h1>
<p>Everything you need to know about sunny Gold Coast, Australia!</p>

<h4>Latest post:</h4>
<?php foreach ($post as $latest) :?>
    <h3><a href="<?= url("post/view/{$latest->postId}"); ?>"><?= $latest->title ?></a></h3>    <p><?=$latest->text?></p>
    <p>By:<?=$latest->acronym?></p>
<?php endforeach; ?>

<h3>Popular tags:</h3>

<?php foreach ($tag as $tags) : ?>
    <a href="<?= url("tag/view/{$tags->tag}"); ?>" class="button"><?= $tags->tag ?></a>
<?php endforeach; ?>
