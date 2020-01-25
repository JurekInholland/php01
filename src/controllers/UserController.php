<?php

class UserController extends Controller {
    
    public function users() {

        if (isset($_GET["q"])) {
            $users = UserService::queryUsers($_GET["q"]);
        } else {
            $users = UserService::getAll();

        }

        self::view("users/user_list", ["users" => $users]);
    }

    public function user() {
        if (isset($_GET["id"])) {
            $user = UserService::getUserById($_GET["id"]);
        } elseif (isset($_GET["name"])) {
            $user = UserService::getUserByName($_GET["name"]);

        } else {
            return self::view("partials/message", ["message" => "No username specified."]);
        }

        if (!empty($user)) {
            $posts = PostService::getPostsByUserId($user->getId());
            // die(var_dump($posts));
        } else {
            return self::view("partials/message", ["message" => "No user found."]);

        }
        // die(var_dump($posts));
        self::view("users/user_profile", ["user" => $user, "posts" => $posts]);

    }
}