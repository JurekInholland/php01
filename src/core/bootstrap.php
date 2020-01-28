<?php

// Load composer autoloader
require '../vendor/autoload.php';

// Autoload classes
spl_autoload_register(function ($class) {
    if (is_file('../src/controllers/' . $class . '.php')) {
        include_once '../src/controllers/' . $class . '.php';


    } else if (is_file('../src/models/' . $class . '.php')) {
        include_once '../src/models/' . $class . '.php';

    } else if (is_file('../src/core/classes/' . $class . '.php')) {
        include_once '../src/core/classes/' . $class . '.php';


    } else if (is_file('../src/exceptions/' . $class . '.php')) {
        include_once '../src/exceptions/' . $class . '.php';

    } else if (is_file('../src/services/' . $class . '.php')) {
        include_once '../src/services/' . $class . '.php';

    } else if (is_file('../src/core/database/' . $class . '.php')) {
        include_once '../src/core/database/' . $class . '.php';

    } else if (is_file('../src/core/router/' . $class . '.php')) {
        include_once '../src/core/router/' . $class . '.php';
    }
});

// include_once '../src/core/router/routes.php';
include_once '../src/core/helpers.php';

// Set correct time zone
date_default_timezone_set('Europe/Amsterdam');

// Load sql credentials from config.ini
$config = parse_ini_file("../src/config/config.ini", true);

// From now on, db can be accessed via App::get("db)
App::bind("db", new QueryBuilder(
    Connection::make($config)
));

App::bind("user", UserService::getCurrentUser());

session_start();