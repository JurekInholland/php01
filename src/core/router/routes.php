<?php

// Each route has a declared method (get or post) and gets
// assigned a controller as well as a controller method.

$router->get("", "StaticController@index");
$router->get("users", "UserController@users");
$router->get("user", "UserController@user");

$router->get("user/edit", "UserController@editProfile");
$router->get("user/create", "UserController@createUser");
$router->post("user/create/submit", "UserController@submitCreate");

$router->get("resetpassword", "AuthController@resetPassword");


$router->post("user/submit", "UserController@submitProfile");

$router->post("user/edit/submit", "UserController@submitEdit");



$router->post("comment/submit", "PostController@submitComment");



$router->get("login", "AuthController@login");
$router->get("logout", "AuthController@logout");
$router->get("register", "AuthController@register");

$router->get("edit", "PostController@editPost");
$router->get("view", "PostController@viewPost");

$router->get("pdf", "PostController@viewAsPdf");




$router->post("login/submit", "AuthController@submitLogin");
// $router->post("logout/submit", "AuthController@submitLogout");
$router->post("register/submit", "AuthController@submitRegister");


$router->post("post/submit", "PostController@submitPost");
$router->get("post/delete", "PostController@deletePost");



$router->get("create", "PostController@createPost");

$router->get("api", "ApiController@index");

$router->get("api/posts", "ApiController@posts");
$router->get("api/users", "ApiController@users");
$router->get("api/cronjob", "ApiController@cronjob");
$router->get("api/cronjob/logs", "ApiController@cronjobLog");



$router->get("about", "StaticController@about");

$router->get("admin", "AdminController@index");
$router->get("admin/import", "AdminController@import");
$router->post("admin/import/submit", "AdminController@submitImport");
$router->get("admin/export", "AdminController@export");

$router->get("admin/export/csv", "AdminController@exportToCsv");
$router->get("admin/export/xls", "AdminController@exportToXls");

$router->get("premium", "PremiumController@index");