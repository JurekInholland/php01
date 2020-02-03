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
        return self::returnResponse($data);
    }

    public function users() {

        if (!empty($_GET["key"]) && !empty($_GET["user"])) {
            // check if api key is valid
            if (UserService::checkApiKey($_GET["user"], $_GET["key"])) {
                $users = UserService::getAll();
                foreach ($users as $user) {
                    $data[] = $user->getData();
                }
                return self::returnResponse($data, 200);
            } 

        } 
        return self::returnResponse(["unauthorized"], 401);
    }

    // /api/post/create
    public function createPost() {

    }


    public function cronjob() {
        if (!empty($_GET["cronjobkey"])) {
            $key = CronjobService::getCronjobKey();

            if ($_GET["cronjobkey"] == $key) {

                // Execute periodic tasks
                CronjobService::doTasks();
                return self::returnResponse([], 200);
            }

        }
        return self::returnResponse([], 401);

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


    public function cronjobLog() {
        $logs = CronjobService::getJobLogs();
        self::returnResponse($logs);
    }
}