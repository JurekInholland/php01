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

        return $result;    
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
        $sql = "SELECT *,
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
}