<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "class" => "my-navbar",

    // Here comes the menu items/structure
    "items" => [
        [
            "text" => "Home",
            "url" => "",
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
