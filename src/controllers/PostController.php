<?php

class PostController extends Controller {

    public function createPost() {

        return self::view("posts/edit_post");

    }
}