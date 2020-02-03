<?php
/**
 * Mount the controller onto a mountpoint.
 */
return [
    "routes" => [
        [
            "info" => "User controller.",
            "mount" => "user",
            "handler" => "\Lyco\User\UserController",
        ],
    ]
];
