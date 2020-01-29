<?php

class PostController extends Controller {

    public function createPost() {

        $post = new Post([]);
        return self::view("posts/edit_post", ["readonly" => "", "post" => $post]);
    }


    public function editPost() {
        if (isset($_GET["post"])) {
            $post = PostService::getPostBySlug($_GET["post"]);

            $comments = PostService::getComments($post[0]->getId());
            return self::view("posts/edit_post", ["readonly" => "readonly", "post" => $post[0], "comments" => $comments]);
        }
    }

    public function viewPost() {
        if (isset($_GET["post"])) {
            $post = PostService::getPostBySlug($_GET["post"]);

            $comments = PostService::getComments($post[0]->getId());
            return self::view("posts/view_post", ["readonly" => "readonly", "post" => $post[0], "comments" => $comments]);
        }
    }

    public function deletePost() {
        if (!empty($_GET["id"])) {
            PostService::deletePostById($_GET["id"]);
        }
        return self::redirect("");
    }

    public function submitPost() {
        if (!empty($_POST)) {
            // die(var_dump(App::get("user")));
            $image = ImageService::upload($_FILES["image"]);

            

            $postValues = [
                "post_title" => $_POST["title"],
                "post_content" => $_POST["content"],
                "privacy" => 0,
                "slug" => createSlug($_POST["title"]),
                "image_id" => $image["id"],
                "filename" => $image["filename"],
                "author" => App::get("user")
            ];

            $post = new Post($postValues);
            // die(var_dump($post));
            PostService::createPost($post);
            self::redirect("");
            
            // die(var_dump($_FILES));
            if ($_POST["post_id"] == "") {
                // PostService::createPost();
            }
        }
    }

    public function submitComment() {

        if (App::get("user")->getRole() == 0) {
            $_SESSION["loginMsg"] = "You must be logged in to post comments.";
            return self::redirect("login");
        }

        if (!empty($_POST["comment"])) {
            $comment = new Comment([
                "comment_text" => $_POST["comment"],
                "post" => $_POST["post_id"],
                "author" => App::get("user"),
                ""
            ]);

            PostService::createComment($comment);
            return self::redirect("view?post={$_POST["post_slug"]}");
        }
        return self::view("partials/message", ["message" => "Comments cannot be empty."]);

    }
}