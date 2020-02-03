<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "id" => "rm-menu",
    "wrapper" => null,
    "class" => "rm-default rm-mobile",

    // Here comes the menu items
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
