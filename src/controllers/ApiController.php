<?php

class ApiController extends Controller {

    public function index() {
        return self::view("api/index");
    }

    public function posts() {
        $posts = PostService::getAll();
        foreach ($posts as $post) {
            $data[] = $post->getData();
        }
        return self::serveJson($data);
    }

    public function users() {

        if (!empty($_GET["key"])) {
            // check if api key is valid
            $users = UserService::getAll();
            foreach ($users as $user) {
                $data[] = $user->getData();
            }

        } else {
            $data = ["status" => "No key passed."];
        }
        

        return self::serveJson($data);
    }

    // /api/post/create
    public function createPost() {

    }

    private static function serveJson(array $jsonData) {
        header('Content-type: application/json');

        if (!empty($jsonData)) {
            $json = ["status" => 200, "data" => $jsonData];
        } else {
            $json = ["status" => 404, "data" => []];
        }
        
        echo json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}