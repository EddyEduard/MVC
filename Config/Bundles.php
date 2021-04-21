<?php

use App\Core\Bundle;

/*
 * Include all files type of CSS.
 * */

// Include style bootstrap files.

Bundle::AddStyles("BootstrapStyles", [
    "public/bootstrap/css/bootstrap.css",
    "public/bootstrap/css/mdb.css",
    "public/bootstrap/css/style.css"
]);

// Include style files for error page.

Bundle::AddStyles("ErrorStyles", [
    "public/css/style.css"
]);

/*
 * Include all files type of JS.
 * */

// Include scripts bootstrap files

Bundle::AddScripts("BootstrapScripts", [
    "public/bootstrap/js/jquery-3.4.1.min.js",
    "public/bootstrap/js/bootstrap.js",
    "public/bootstrap/js/popper.min.js",
    "public/bootstrap/js/mdb.min.js",
]);

// Include content scripts.

Bundle::AddScripts("ContentScripts", [
    "public/js/main.js"
]);

// Include API scripts.

Bundle::AddScripts("APIScripts", [
    "public/js/api.js"
]);