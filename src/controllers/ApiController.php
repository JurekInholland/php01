<?php

class ApiController extends Controller {

    public function index() {
        return self::view("api/index");
    }

    public function posts() {
        $posts = PostService::
    }
}