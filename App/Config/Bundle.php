<?php

use App\Core\BundleCore as Bundle;

/*
 * Bundle region for style app files
 * Include all files type of CSS
 * */

// Include style bootstrap files

Bundle::AddBundleStyles("BootstrapStyles", [
    "/public/bootstrap/css/bootstrap.css",
    "/public/bootstrap/css/mdb.css",
    "/public/bootstrap/css/style.css"
]);

// Include style files for error page

Bundle::AddBundleStyles("ErrorStyles", [
    "/public/css/style.css"
]);

/*
 * Bundle region for scripts app files
 * Include all files type of JS
 * */

// Include scripts files

// Include scripts bootstrap files

Bundle::AddBundleScripts("BootstrapScripts", [
    "/public/bootstrap/js/jquery-3.4.1.min.js",
    "/public/bootstrap/js/bootstrap.js",
    "/public/bootstrap/js/popper.min.js",
    "/public/bootstrap/js/mdb.min.js",
]);

Bundle::AddBundleScripts("ContentScripts", [
    "/public/js/main.js"
]);

Bundle::AddBundleScripts("APIScripts", [
    "/public/js/api.js"
]);