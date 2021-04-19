<?php

use App\Core\Router as Router;

/*
 * Controllers for view pages.
 * */

// View Home page.
Router::Get("/", [
    "controller" => "Home",
    "action" => "Index"
]);

// View About page.
Router::Get("/About", [
    "controller" => "Home",
    "action" => "About"
]);

// View Contact page.
Router::Get("/Contact", [
    "controller" => "Home",
    "action" => "Contact"
]);

/*
 * Controllers for Web APIs.
 * */

// Get all values.
Router::Get("/API/Get", [
    "controller" => "Values",
    "action" => "Get"
]);

// Get a value by id.
Router::Get("/API/GetById/{id}", [
    "controller" => "Values",
    "action" => "GetById"
]);

// Find a value by name column and its value.
Router::Get("/API/Find/{column}/{value}", [
    "controller" => "Values",
    "action" => "Find"
]);

// Select all values by column and its value.
Router::Get("/API/Where/{column}/{value}", [
    "controller" => "Values",
    "action" => "Where"
]);

// Insert a new value.
Router::Post("/API/Post", [
    "controller" => "Values",
    "action" => "Post"
]);

// Update a value by id.
Router::Put("/API/Put/{id}", [
    "controller" => "Values",
    "action" => "Put"
]);

// Delete a value by id.
Router::Delete("/API/Delete/{id}", [
    "controller" => "Values",
    "action" => "Delete"
]);