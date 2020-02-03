<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "wrapper" => null,
    "class" => "my-navbar rm-default rm-desktop",

    // Here comes the menu items
    "items" => [
        [
            "text" => "Home",
            "url" => "index.php",
            "title" => "First page.",
        ],
        [
            "text" => "Posts",
            "url" => "post",
            "title" => "Questions.",
        ],
        [
            "text" => "Tags",
            "url" => "tag",
            "title" => "Tags.",
        ],
        [
            "text" => "About",
            "url" => "about",
            "title" => "About this page",
        ],
    ],
];
