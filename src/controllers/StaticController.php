<?php

class StaticController extends Controller {

    public function index() {
        $hello = "Hello world";
        // return self::view("index/home", ["message" => $hello]);

        $posts = PostService::getAll();
        return self::view("index/home", ["posts" => $posts]);
    }


    public function notFound() {
        return self::view("partials/not_found");
    }

    public function about() {
        return self::view("about");
    }
}