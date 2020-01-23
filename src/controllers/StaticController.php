<?php

class StaticController extends Controller {

    public function index() {
        $hello = "Hello world";
        // return self::view("index/home", ["message" => $hello]);

        $posts = PostService::getAll();
        die(var_dump($posts));
        return self::view("posts/overview");
    }
}