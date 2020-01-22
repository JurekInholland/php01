<?php

class Controller {

    // Prettier redirect
    public static function redirect($path) {
        return header("Location: /{$path}");
    }


    // Controllers 'view' Views... 
    public static function view(string $viewName, array $data = []) {
        extract($data);

        // Require general view partials required on every page
        require "../src/views/partials/head.php";
        // ...

        // Require the requested view
        require "../src/views/{$viewName}.php";

        session_unset();
    }
}