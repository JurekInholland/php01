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


    public function cronjob() {
        if (empty($_GET["cronjobkey"])) {
            return self::returnResponse([], 401);
        }

        

    }

    private static function returnResponse(array $data, int $statusCode=200) {
        $response = ["status" => $statusCode, "data" => $data];

        self::serveJson($response);
    }

    private static function serveJson(array $jsonData) {
        header('Content-type: application/json');

        // JSON_UNESCAPED_SLASHES = valid links with unescaped slashes
        echo json_encode($jsonData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}