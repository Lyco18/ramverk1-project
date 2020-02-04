<?php

namespace Anax\View;

/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$comments = isset($comments) ? $comments : null;
$tags = isset($tags) ? $tags : null;

// Create urls for navigation
$urlToCreate = url("tag/create");

?><h1>Viewing post</h1>

<?php if (!$post) : ?>
    <p>There are no posts to show.</p>
<?php
    return;
endif;
?>

<table>
    <tr>
        <td><h3><?= $post->title ?> </h3></td>
    </tr>
    <tr>
        <td><?= $post->text ?></td>
    </tr>
    <tr>
        <td>
            <p>
                Post Id: <?= $post->postId ?><br>
                Made by: <?= $post->acronym ?><br>
            </p>
        </td>
    </tr>
</table>
<p>
    <a href="<?= url("tag/create/{$post->postId}") ?>" class="button">Create or add tag</a>
    <a href="<?= url("comment/create/{$post->postId}"); ?>" class="comment button">Comment</a>
</p>
<h3>Comments:</h3>
<?php if (!$comments) : ?>
    <p>There are no comments to show.</p>
<?php
    return;
endif;
?>
<?php foreach ($comments as $comment) : ?>
        <?=$comment->id . ": " . $comment->text ?><br><br>
        <?php if ($userId == $comment->id) : ?>
        <a href="<?= url("comment/update/{$comment->commentId}"); ?>" class="button">Edit your comment</a>
    <?php endif; ?>
<?php endforeach; ?>

<h3>Tags:</h3>
<?php if ($tags == null) : ?>
    <p>There are no tags to show.</p>
<?php
    return;
endif;
foreach ($tags as $tag) :
    $array[] = $tag->tag;
endforeach;
$tagArray = array_unique($array);
foreach ($tagArray as $tags) : ?>
    <a href="<?= url("tag/view/{$tags}"); ?>" class="button"><?= $tags ?></a>
<?php endforeach; ?>
<br><br>
<a href="<?= url("post") ?>" class="button">Show all posts</a>
