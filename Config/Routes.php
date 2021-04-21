<?php

use App\Core\Route;

/*
 * Controllers for view pages.
 * */

// View Home page.
Route::Get("/", [
    "controller" => "Home",
    "action" => "Index"
]);

// View About page.
Route::Get("/About", [
    "controller" => "Home",
    "action" => "About"
]);

// View Contact page.
Route::Get("/Contact", [
    "controller" => "Home",
    "action" => "Contact"
]);

/*
 * Controllers for Web APIs.
 * */

// Get all values.
Route::Get("/API/Get", [
    "controller" => "Values",
    "action" => "Get"
]);

// Get a value by id.
Route::Get("/API/GetById/{id}", [
    "controller" => "Values",
    "action" => "GetById"
]);

// Find a value by name column and its value.
Route::Get("/API/Find/{column}/{value}", [
    "controller" => "Values",
    "action" => "Find"
]);

// Select all values by column and its value.
Route::Get("/API/Where/{column}/{value}", [
    "controller" => "Values",
    "action" => "Where"
]);

// Insert a new value.
Route::Post("/API/Post", [
    "controller" => "Values",
    "action" => "Post"
]);

// Update a value by id.
Route::Put("/API/Put/{id}", [
    "controller" => "Values",
    "action" => "Put"
]);

// Delete a value by id.
Route::Delete("/API/Delete/{id}", [
    "controller" => "Values",
    "action" => "Delete"
]);