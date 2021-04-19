<?php
/* Application name. */
define("APP_NAME", "MVC Template");

/* Application author */
define("AUTHOR", "Eduard-Nicolae");

/* Application description */
define("DESCRIPTION", "MVC Template");

/* Base address application. */
define("BASE_ADDRESS", $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"] . "/MVC/");

/* Add databases */
define("MVC", [
    "host" => $_SERVER["SERVER_NAME"],
    "username" => "root",
    "password" => "",
    "name" => "MVC"
]);

/* Cookie configurations */
define("COOKIE_SETTING", [
    "DEFAULT_TIME_LIFE" => [
        "day" => 3,
        "hours" => 24,
        "minutes" => 60,
        "seconds" => 60
    ],
    "PATH" => $_SERVER["REQUEST_URI"],
    "DOMAIN" => $_SERVER["SERVER_NAME"],
    "SECURE" => false,
    "HTTPONLY" => false
]);
