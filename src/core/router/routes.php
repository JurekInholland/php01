<?php

// Each route has a declared method (get or post) and gets
// assigned a controller as well as a controller method.

$router->get("", "StaticController@index");
$router->get("users", "UserController@users");
$router->get("user", "UserController@user");

$router->get("login", "AuthController@login");
$router->get("logout", "AuthController@logout");
$router->get("register", "AuthController@register");

$router->get("edit", "PostController@editPost");



$router->post("login/submit", "AuthController@submitLogin");
// $router->post("logout/submit", "AuthController@submitLogout");
$router->post("register/submit", "AuthController@submitRegister");


$router->post("post/submit", "PostController@submitPost");



$router->get("create", "PostController@createPost");

$router->get("api", "ApiController@index");

$router->get("api/posts", "ApiController@posts");
$router->get("api/users", "ApiController@users");

$router->get("about", "StaticController@about");

