<?php

// Load dependencies
include"../src/core/bootstrap.php";

// Routes connect uri's to controllers
// Controllers are entrypoints for routes
$router = new Router();

// Load all defined routes
$router = Router::load("../src/core/router/routes.php");

// determine & require desired controller for route

$router->direct(Request::uri(), Request::method());