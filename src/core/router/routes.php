<?php

// Each route has a declared method (get or post) and gets
// assigned a controller as well as a controller method.

$router->get("", "StaticController@index");
$router->get("users", "UserController@users");
$router->get("user", "UserController@user");

$router->get("login", "AuthController@login");
$router->get("logout", "AuthController@logout");
$router->get("register", "AuthController@register");

$router->post("login/submit", "AuthController@submitLogin");
// $router->post("logout/submit", "AuthController@submitLogout");
$router->post("register/submit", "AuthController@submitRegister");