<?php

namespace Anax\View;

/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

// Create urls for navigation
$urlToCreate = url("post/create");



?><h1>View all posts</h1>
<p><a href="<?= url("user/logout"); ?>">Log out!</a></p>

<p>
    <a href="<?= $urlToCreate ?>">Create a post</a>
</p>

<?php if (!$items) : ?>
    <p>There are no posts to show.</p>
<?php
    return;
endif;
?>

<table>
    <tr>
    <?php foreach ($items as $item) : ?>
    <tr>
        <td><h3><a href="<?= url("post/view/{$item->postId}"); ?>"><?= $item->title ?></a> </h3></td>
    </tr>
    <tr>
        <td><?= $item->text ?></td>
    </tr>
    <tr>
        <td>
            <p>Post Id: <?= $item->postId ?><br>
            Made by: <?= $item->acronym ?></p>
            <a href="<?= url("comment/create/{$item->postId}"); ?>" class="comment button">Reply</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
