<?php

class UserService {
    
    public static function getAll() {
        $sql = "SELECT *,
        (SELECT COUNT(*) FROM cms_posts
        WHERE cms_users.id = user_id) AS post_count
        FROM cms_users
        LEFT JOIN cms_role_names ON cms_users.role = cms_role_names.role_id
        LEFT JOIN cms_images ON cms_users.profile_image = cms_images.image_id
        ORDER BY name";

        $data = App::get("db")->query($sql);
        foreach ($data as $userdata) {
            $result[] = new User($userdata);
        }

        return $result ?? [];    
    }


    public static function queryUsers($query) {
        $sql = "SELECT *,
        (SELECT COUNT(*) FROM cms_posts
        WHERE cms_users.id = user_id) AS post_count
        FROM cms_users
        LEFT JOIN cms_role_names ON cms_users.role = cms_role_names.role_id
        LEFT JOIN cms_images ON cms_users.profile_image = cms_images.image_id

        WHERE name LIKE :query OR email LIKE :query OR registration_date LIKE :query
        ORDER BY name";
        $params = [":query" => "%{$query}%"];

        $data = App::get("db")->query($sql, $params);
        foreach ($data as $userdata) {
            $result[] = new User($userdata);
        }

        return $result;    

    }

    public static function getUserById($userId) {
        $sql = "SELECT *,
        (SELECT COUNT(*) FROM cms_posts
        WHERE cms_users.id = user_id) AS post_count
        FROM cms_users
        LEFT JOIN cms_role_names ON cms_users.role = cms_role_names.role_id
        LEFT JOIN cms_images ON cms_users.profile_image = cms_images.image_id

        WHERE id=:id";

        $params = [":id" => $userId];

        $user = App::get("db")->query($sql, $params);
        if (!empty($user[0])) {
            return new User($user[0]); 
        }
    }

    // SELECT *,
    // (SELECT COUNT(*) FROM cms_posts
    //         WHERE cms_users.id = user_id) AS post_count
    
    // from cms_users, cms_posts

    public static function getUserByName($userName) {
        $sql = "SELECT *, cms_images.*,
                (SELECT COUNT(*) FROM cms_posts
                WHERE cms_users.id = user_id) AS post_count
                FROM cms_users
                LEFT JOIN cms_role_names ON cms_users.role = cms_role_names.role_id
                LEFT JOIN cms_images ON cms_users.profile_image = cms_images.image_id
                WHERE name=:name";

        $params = [":name" => $userName];

        $user = App::get("db")->query($sql, $params);
        if (!empty($user[0])) {
            return new User($user[0]); 
        }
    }


    public function getCurrentUser() {
        if (!empty($_COOKIE["pictur_login"])) {
            $sql = "SELECT cms_login_tokens.user_id as id, cms_users.*, cms_images.* FROM cms_login_tokens
                    LEFT JOIN cms_users ON cms_login_tokens.user_id = cms_users.id
                    LEFT JOIN cms_images ON cms_users.profile_image = cms_images.image_id
                    WHERE cms_login_tokens.token = :token";

            $params = [":token" => sha1($_COOKIE["pictur_login"])];
            $userdata = App::get("db")->query($sql, $params);
            // die(var_dump($userdata));
            if (!empty($userdata[0])) {
                $user = new User($userdata[0]);
                $user->setLoggedIn();
                return $user;
            }
        }

        // If cookie is not set or no valid token is found, return guest user
        $guestUser = [
            "username" => "Guest",
            "role" => 0,
            "id" => 0,
        ];
        return new User($guestUser);
    }

    public function register(array $credentials) {
        $sql = "SELECT * FROM cms_users WHERE name LIKE :username OR email LIKE :email";
        $params = [":username" => $credentials["username"], 
                   ":email" => $credentials["email"]];
        $userdata = App::get("db")->query($sql, $params);
        if (!empty($userdata[0])) {
            $user = $userdata[0];
        } else {
            $user = [];
        }

        $existingUser = new User($user);

        // Check if username or email are already in use
        if ($credentials["username"] == $existingUser->getName()) {
            return "This username is already in use.";
        } else if ($credentials["email"] == $existingUser->getEmail()) {
            return "This email is already in use.";
        }

        if (strlen($credentials["password"]) >= 5 && strlen($credentials["password"]) <= 32) {
            $credentials["password"] = password_hash($credentials["password"], PASSWORD_BCRYPT);

            return self::createUser($credentials);

        }
        return "Password must be between 5 and 32 characters.";

    }

    private static function createUser(array $userdata) {
        // TODO: Validate input

        extract($userdata);

        $sql = "INSERT INTO cms_users (`name`, `email`, `password`, `role`) VALUES (:username, :email, :password, :role)";
        $params = [":username" => $username,
                   ":email" => $email,
                   ":password" => $password,
                   ":role" => 1];
        
        App::get("db")->query($sql, $params);
        return;

    }

    public static function deleteUser(string $userid) {
        $sql = "DELETE FROM cms_users WHERE id=:id";

        $params = [":id" => $userid];

        App::get("db")->query($sql, $params);
    }

    public static function editUser(array $userdata) {

        $user = UserService::getUserById($userdata["id"]);
        $currentInfo = [
            "name" => $user->getName(),
            "email" => $user->getEmail(),
            "password" => $user->getPassword(),
            "profile_image" => $user->getPictureId()
        ];


        $params = [];

        foreach ($userdata as $key => $value) {
            if (empty($value)) {
                $params[$key] = $currentInfo[$key];

            } elseif ($key == "password") {
                $params[$key] = password_hash($value, PASSWORD_BCRYPT);
            }

            else {
                $params[$key] = $value;
            }
        }


        $sql = "UPDATE cms_users SET name=:name, email=:email, password=:password, profile_image=:profile_image
        WHERE id=:id";

        App::get("db")->query($sql, $params);

    }



    public function login(array $credentials) {
        $sql = "SELECT * FROM cms_users
        WHERE email LIKE :username OR name LIKE :username";

        $params = [":username" => $credentials["username"]];

        $userdata = App::get("db")->query($sql, $params);

        if(empty($userdata[0])) {
            return "User not found.";
        }
        $user = new User($userdata[0]);

        if (password_verify($credentials["password"], $user->getPassword())) {
            return self::storeLogin($user);
        }
        return "Password does not match.";
    }

    private static function storeLogin(User $user) {
        $crypto = True;
        $token = bin2hex(openssl_random_pseudo_bytes(64, $crypto));
        // Hash token
        $hashed_token = sha1($token);

        $sql = "INSERT INTO cms_login_tokens (token, `user_id`) VALUES (:token, :user_id)
                ON DUPLICATE KEY UPDATE token=VALUES(token)";
        $params = [":token" => $hashed_token, ":user_id" => $user->getId()];

        App::get("db")->query($sql, $params);
        setcookie("pictur_login", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
    }

    public function logout() {
        if (!empty($_COOKIE["pictur_login"])) {
            $sql = "DELETE FROM cms_login_tokens WHERE token = :token";
            $params = [":token" => sha1($_COOKIE["pictur_login"])];
            App::get("db")->query($sql, $params);

            // Expire login cookie
            setcookie("pictur_login", "1", time() - 300);
        }
    } 
}