<?php

class PostController extends Controller {

    public function createPost() {

        $post = new Post([]);
        return self::view("posts/edit_post", ["readonly" => "", "post" => $post]);
    }


    public function editPost() {
        if (isset($_GET["post"])) {
            $post = PostService::getPostBySlug($_GET["post"]);
            return self::view("posts/edit_post", ["readonly" => "readonly", "post" => $post[0]]);
        }
    }

    public function submitPost() {
        if (!empty($_POST)) {
            die(var_dump($_POST));
            if ($_POST["post_id"] == "") {
                PostService::createPost()
            }
        }
    }
}