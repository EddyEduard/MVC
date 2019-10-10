<?php

/* Add databases */
define("MVC", [
   "host" => "localhost",
   "username" => "root",
   "password" => "",
   "name" => "MVC"
]);

/* App name. */
define("APP_NAME", "App");

/* Author app */
define("AUTHOR", "Eduard-Nicolae");

/* Describe app */
define("DESCRIBE", "MVC Framework");

/* Base address app. */
define("BASE_ADDRESS", $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"]);
