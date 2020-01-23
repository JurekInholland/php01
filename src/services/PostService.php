<?php

class PostService {

    public function getAll() {
        $sql = "SELECT cms_posts.*, cms_users.*, cms_images.* FROM cms_posts
        -- LEFT JOIN cms_comments ON cms_posts.post_id = cms_comments.post
        LEFT JOIN cms_images ON cms_images.image_id = post_image
        LEFT JOIN cms_users ON cms_users.id = cms_posts.user_id";

        $data = App::get("db")->query($sql);

        foreach ($data as $postinfo) {
            $posts[] = new Post($postinfo);
            
        }
       
        // die(var_dump($posts));

        return $posts;

    }

    public function uploadImages(array $images) {
        $sql = "INSERT INTO cms_images (image_id, filename, extension) VALUES
                ()";
    }
}