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
        } else {
            return self::view("partials/message", ["message" => "No user found."]);

        }
        return self::view("users/user_profile", ["user" => $user, "posts" => $posts]);

    }

    public function createUser() {

        if (!App::get("user")->getRole() > 0) {
            return self::view("partials/message", ["message" => "You are not allowed to create new users. Please sign up."]);
        }

        $rolenames = UserService::getRoleNames();
        return self::view("users/create_user", ["roles" => $rolenames]);
    }


    public function editProfile() {
        if (isset($_GET["id"])) {

            if (!self::adminPrivileges($_GET["id"])) {
                return self::view("partials/message", ["message" => "You are not authorized to edit this profile."]);
            }

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
        $currentUser = App::get("user");

        if (!self::adminPrivileges($id)) {
            return self::view("partials/message", ["message" => "You are not authorized to do this."]);

        }

        if (isset($_POST["edit"])) {

            return self::redirect("user/edit?id={$id}");

        } elseif (isset($_POST["delete"])) {
            UserService::deleteUser($id);

        } elseif (isset($_POST["login_on_behalf"])) {
            UserService::loginAs($id);
        }
        return self::redirect("users");

    }



    public function submitEdit() {

        if (!empty($_POST["cancel"])) {
            return self::redirect("user?id={$_POST["id"]}");
        }

        if (!self::adminPrivileges($_POST["id"])) {
            return self::view("partials/message", ["message" => "You are not authorized to edit this profile."]);
        }

        if (!empty($_POST["submitBtn"])) {
    
            $imageId = "";
            if (!empty($_FILES["profile_image"]["name"])) {
                $image = ImageService::upload($_FILES["profile_image"]);
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


        // Generate API key
        } else {
            $key = generateUuid(16);
            UserService::setApiKey($_POST["id"], $key);
            return self::redirect("user/edit?id={$_POST["id"]}");
        }
        

    }

    public function submitCreate() {
        if (!empty($_POST)) {
            $userinfo = [
                "username" => $_POST["username"],
                "email" => $_POST["email"],
                "password" => $_POST["password"],
                "role" => $_POST["role"]
            ];
            if (UserService::createUser($userinfo)) {
                return self::redirect("user/edit?name={$_POST["username"]}");
            } else {
                return self::view("partials/message", ["message" => "User already exists."]);
            }

           
        }
    }
}