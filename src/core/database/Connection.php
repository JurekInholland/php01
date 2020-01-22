  
<?php

// Connection class responsible for making and returing a database connection
class Connection {

    // Pass config object holding sensitive database information to make method
    public static function make($config) {
        try {       
            return new PDO(
                "mysql:host=".$config["host"].";dbname=".$config["dbname"],
                $config["username"],
                $config["password"],

                // Pass fixed PDO errormode
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            die("Critical database failure: {$e}");
        }
    }
}