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

?><h1>View Posts with tags</h1>

<?php if (!$tags) : ?>
    <p>There are no tags to show.</p>
<?php
    return;
endif;
?>

</h3><?= $tags ?></h3>

<br><a href="<?= url("tag") ?>">Show all tags</a>
