<?php

class PostService {

    public function getAll() {
        $sql = "SELECT cms_posts.*, cms_users.*, cms_images.*, cms_comments.* FROM cms_posts
        LEFT JOIN cms_comments ON cms_posts.post_id = cms_comments.post
        LEFT JOIN cms_images ON cms_images.image_id = post_image
        LEFT JOIN cms_users ON cms_users.id = cms_posts.user_id";

        $data = App::get("db")->query($sql);
        die(var_dump($data));

        $posts = [];
        $comments = [];

        foreach ($data as $postinfo) {
            $posts[$postinfo["post_id"]] = $postinfo;
            // var_dump($postinfo);
            if (isset($postinfo["comment_id"])) {
                // array_push($posts[$postinfo["post_id"]]["comments"], new Comment($postinfo));
                $comments[$postinfo["post_id"]][$postinfo["comment_id"]] = new Comment($postinfo);
                // $posts[$postinfo["post_id"]]["comments"][] = new Comment($postinfo);

            }
        }
        foreach ($posts as $post) {
            // die(var_dump($post));
            $post["comments"] = $comments[$post["post_id"]];
            $result[] = new Post($post);
            var_dump($post);
        }
        die(var_dump($result));

        return $result;

    }
}