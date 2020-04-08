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
        require "../src/views/partials/navigation.php";

        // Require the requested view
        require "../src/views/{$viewName}.php";
        require "../src/views/partials/footer.php";

        session_unset();
    }

    // Check if the user with the given id is authorized. Either by having the same id
    // or by having a role of Administrator or Superadministrator.
    protected static function adminPrivileges($id) {
        $currentUser = App::get("user");
        if ($currentUser->getRole() < 2 && $currentUser->getId() != $id) {
            return false;
        }
        return true;
    }
}