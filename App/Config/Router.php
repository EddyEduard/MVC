<?php

use App\Core\RouterCore as Router;

// Controllers for view pages.

Router::Get("",[
    "controller" => "Home",
    "action" => "Index"
]);

Router::Get("About",[
    "controller" => "Home",
    "action" => "About"
]);

Router::Get("Contact",[
    "controller" => "Home",
    "action" => "Contact"
]);

// Controllers for REST APIs.

Router::Get("API/All",[
    "controller" => "Values",
    "action" => "All"
]);

Router::Get("API/Find/{column}/{value}",[
    "controller" => "Values",
    "action" => "Find"
]);

Router::Get("API/Where/{column}/{value}",[
    "controller" => "Values",
    "action" => "Where"
]);

Router::Post("API/Insert",[
    "controller" => "Values",
    "action" => "Insert"
]);

Router::Put("API/Update/{id}",[
    "controller" => "Values",
    "action" => "Update"
]);

Router::Delete("API/Delete/{id}",[
    "controller" => "Values",
    "action" => "Delete"
]);

new Router();