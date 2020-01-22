<?php

class StaticController extends Controller {

    public function index() {
        $hello = "Hello world";
        return self::view("index/home", ["message" => $hello]);
    }
}