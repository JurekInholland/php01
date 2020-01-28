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
        return self::view("users/user_profile", ["user" => $user, "posts" => $posts]);

    }

    public function createUser() {
        return self::view("users/create_user");
    }


    public function editProfile() {
        if (isset($_GET["id"])) {
            $user = UserService::getUserById($_GET["id"]);
        } elseif (isset($_GET["name"])) {
            $user = UserService::getUserByName($_GET["name"]);

        } else {
            return self::view("partials/message", ["message" => "No username specified."]);
        }


        return self::view("users/edit_profile", ["user" => $user]);

    }

    public function submitProfile() {
        $id = $_POST["id"];

        if (isset($_POST["edit"])) {
            return self::redirect("user/edit?id={$id}");

        } elseif (isset($_POST["delete"])) {
            UserService::deleteUser($id);
            return self::redirect("users");
        }
    }


    public function submitEdit() {

        $imageId = "";
        if (!empty($_FILES["profile_image"]["name"])) {
            $image = UploadService::upload($_FILES["profile_image"]);
            $imageId = $image["id"];
        }




        $userinfo = [
            "id" => $_POST["id"],            
            "name" => $_POST["name"],
            "email" => $_POST["email"],
            "password" => $_POST["password"],
            "profile_image" => $imageId
        ];
        // die (var_dump($imageId));

        UserService::editUser($userinfo);
        return self::redirect("user?id={$_POST["id"]}");

    }
}