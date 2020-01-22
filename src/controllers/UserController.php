<?php

class UserController extends Controller {
    
    public function users() {
        $users = UserService::getAll();
        self::view("users/user_list", ["users" => $users]);
    }

    public function user() {
        if (isset($_GET["id"])) {
            $user = UserService::getUserById($_GET["id"]);
            self::view("users/user_profile", ["user" => $user]);
        }
    }
}