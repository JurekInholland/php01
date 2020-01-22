<?php

// Each route has a declared method (get or post) and gets
// assigned a controller as well as a controller method.

$router->get("", "StaticController@index");
$router->get("users", "UserController@users");
$router->get("user", "UserController@user");