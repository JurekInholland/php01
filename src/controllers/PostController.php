<?php

class PostController extends Controller {

    public function createPost() {

        $post = new Post([]);
        return self::view("posts/edit_post", ["readonly" => "", "post" => $post]);
    }


    public function editPost() {
        if (isset($_GET["post"])) {
            $post = PostService::getPostBySlug($_GET["post"]);
            if (!self::adminPrivileges($post[0]->getAuthor()->getId())) {
                return self::view("partials/message", ["message" => "You are not privileged to edit this post."]);

            }

            $comments = PostService::getComments($post[0]->getId());
            return self::view("posts/edit_post", ["readonly" => "", "post" => $post[0], "comments" => $comments]);
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

            if (!self::adminPrivileges($_GET["id"])) {
                return self::view("partials/message", ["message" => "You are not privileged to delete this post."]);

            }

            PostService::deletePostById($_GET["id"]);
        }
        return self::redirect("");
    }

    public function submitPost() {

        if (App::get("user")->getRole() == 0) {
            $_SESSION["loginMsg"] = "You must be logged in to create posts.";
            return self::redirect("login");
        }

        if (!empty($_POST)) {

            $privacy = 0;
            if (isset($_POST["privacy"])) {
                $privacy = 1;
            }

            // New post
            if ($_POST["post_id"] == "") {
                $image = ImageService::upload($_FILES["image"]);
                
                

                $postValues = [
                    "post_title" => $_POST["title"],
                    "post_content" => $_POST["content"],
                    "privacy" => $privacy,
                    "slug" => createSlug($_POST["title"]),
                    "image_id" => $image["id"],
                    "filename" => $image["filename"],
                    "author" => App::get("user")
                ];
    
                $post = new Post($postValues);
                PostService::createPost($post);

            // Edit existing post
            } elseif ($_POST["post_id"] != "") {
                $postValues = [
                    "post_id" => $_POST["post_id"],
                    "post_title" => $_POST["title"],
                    "post_content" => $_POST["content"],
                    "privacy" => $privacy,
                    "slug" => createSlug($_POST["title"])
                ];


                $post = new Post($postValues);
                PostService::editPost($post);
            }
        }
        return header("Location: {$post->getViewLink()}");


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

    public function viewAsPdf() {
        if (isset($_GET["post"])) {
            $post = PostService::getPostBySlug($_GET["post"]);

            $data = $post[0];
            $pdf = PdfService::generatePdf($data);
            ob_end_clean();
            return $pdf->Output("post_{$post[0]->getId()}.pdf", 'I');

        }
    }
}