<?php

class UserService {
    
    public static function getAll() {
        $sql = "SELECT * FROM cms_users
        LEFT JOIN cms_role_names ON cms_users.role = cms_role_names.role_id
        ORDER BY name";

        $data = App::get("db")->query($sql);
        foreach ($data as $userdata) {
            $result[] = new User($userdata);
        }

        return $result;    
    }


    public static function queryUsers($query) {
        $sql = "SELECT * FROM cms_users
        LEFT JOIN cms_role_names ON cms_users.role = cms_role_names.role_id
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
        $sql = "SELECT * FROM cms_users
        LEFT JOIN cms_role_names ON cms_users.role = cms_role_names.role_id
        WHERE id=:id";

        $params = [":id" => $userId];

        $user = App::get("db")->query($sql, $params);
        if (!empty($user[0])) {
            return new User($user[0]); 
        }
    }

    public static function getUserByName($userName) {
        $sql = "SELECT * FROM cms_users WHERE name=:name";

        $params = [":name" => $userName];

        $user = App::get("db")->query($sql, $params);
        if (!empty($user[0])) {
            return new User($user[0]); 
        }
    }
}