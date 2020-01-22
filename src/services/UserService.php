<?php

class UserService {
    
    public static function getAll() {
        $sql = "SELECT * FROM cms_users";

        $data = App::get("db")->query($sql);
        // die(var_dump($data));
        foreach ($data as $userdata) {
            $user = new User($userdata);
            $result[] = $user;
        }

        return $result;    
    }

    public static function getUserById($userId) {
        $sql = "SELECT * FROM cms_users WHERE id=:id";

        $params = [":id" => $userId];

        $user = App::get("db")->query($sql, $params);
        // die(var_dump($user[0]));
        return new User($user[0]); 
    }
}