<?php

class AdminController extends Controller {

    // Entire controller is protected
    public function __construct() {
        if (App::get("user")->getRole() < 1) {
            return self::view("partials/message", ["message" => "You must be an administrator to view this page."]);
        }
    }

    public function index() {
        return self::view("admin/index");
    }

    public function export() {
        return self::view("admin/export");
    }

    public function import() {
        return self::view("admin/import");
    }

    public function exportToXls() {
        $users = (array)UserService::getAll();
        $all = [];
        foreach ($users as $user) {
            array_push($all, $user->getData());
        }
        header("Content-Disposition: attachment; filename=\"users.xlsx\"");
        header("Content-Type: application/download");
        SpreadsheetService::make($all);
    }

    public function exportToCsv() {

        $fp = fopen("php://output", "w");
        $users = UserService::getAll();

        foreach ($users as $user) {
            $userinfo = $user->getData();
            fputcsv($fp, $userinfo);
        }

        // Partially taken from:
        // https://stackoverflow.com/a/16251849

        // reset the file pointer to the start of the file
        rewind($fp);
        // tell the browser it's going to be a csv file
        header('Content-Type: application/csv; charset=UTF-8');
        // tell the browser we want to save it instead of displaying it
        header('Content-Disposition: attachment; filename="users.csv";');
        // make php send the generated csv lines to the browser
        fpassthru($fp);
        return $fp;

    }


    public function submitImport() {
        try {
            if ($_FILES["users"]["error"] != 0) {
                throw new RuntimeException("FILE NOT FOUND");
            }
            if ($_FILES["users"]["size"] == 0 || $_FILES["users"]["size"] >= 1000000) {
                throw new RuntimeException("Invalid file size.");
            }
            if ($_FILES["users"]["type"] != "text/csv") {}

            // https://stackoverflow.com/a/27863772
            $tmpName = $_FILES['users']['tmp_name'];
            $csvAsArray = array_map('str_getcsv', file($tmpName));
            
            $all = UserService::getAll();
            foreach ($csvAsArray as $idx => $user) {

                if ($user != "") {
                    foreach ($all as $dbuser) {
                        if ($user[1] == $dbuser->getName()) {
                            $csvAsArray[$idx][5] = "alreasy";
                        }
                    }
                   
                }
                
            }

        } catch (RuntimeException $e) {
            $error = "Error during upload: {$e->getMessage()}";
            return self::view("partials/message", ["message" => $error]);
        }

    }
}
