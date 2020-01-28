<?php

class PostService {

    // TODO: check needed ?
    public function getPostComments($postId) {
        $sql = "SELECT *, cms_users.* FROM cms_comments
        LEFT JOIN cms_users ON cms_users.id = cms_comments.user_id
        WHERE post = :post";

        $params = [":post" => $postId];
        $data = App::get("db")->query($sql, $params);
        foreach ($data as $comment) {
            $comments[] = new Comment($comment);
        }
        return $comments;
    }

    public function getPostsByUserId($userId) {
        $sql = "SELECT cms_posts.*, cms_users.*, cms_images.*, cms_role_names.* FROM cms_posts
        LEFT JOIN cms_images ON cms_images.image_id = post_image
        LEFT JOIN cms_users ON cms_users.id = cms_posts.user_id
        LEFT JOIN cms_role_names ON cms_users.role = cms_role_names.role_id
        WHERE cms_posts.user_id = :id
        ORDER BY post_date DESC";

        $params = [":id" => $userId];
        $data = App::get("db")->query($sql, $params);
        return self::returnPosts($data);
    }


    public function getPostBySlug($slug) {
        $sql = "SELECT cms_posts.*, cms_users.*, cms_images.*, cms_role_names.* FROM cms_posts
        LEFT JOIN cms_images ON cms_images.image_id = post_image
        LEFT JOIN cms_users ON cms_users.id = cms_posts.user_id
        LEFT JOIN cms_role_names ON cms_users.role = cms_role_names.role_id
        WHERE cms_posts.slug = :slug
        ORDER BY post_date DESC";


        $params = [":slug" => $slug];
        $data = App::get("db")->query($sql, $params);
        return self::returnPosts($data);
    }

    public function getAll() {
        $sql = "SELECT cms_posts.*, cms_users.*, cms_images.*, cms_role_names.* FROM cms_posts
        -- LEFT JOIN cms_comments ON cms_posts.post_id = cms_comments.post
        LEFT JOIN cms_images ON cms_images.image_id = post_image
        LEFT JOIN cms_users ON cms_users.id = cms_posts.user_id
        LEFT JOIN cms_role_names ON cms_users.role = cms_role_names.role_id
        ORDER BY post_date DESC";



        $data = App::get("db")->query($sql);

        foreach ($data as $postinfo) {
            $posts[] = new Post($postinfo);
            
        }
       
        // die(var_dump($posts));

        return $posts;

    }

    private function returnPosts(array $postdata) {
        foreach ($postdata as $postinfo) {
            $posts[] = new Post($postinfo);
        }

        if (!empty($posts)) {
            return $posts;

        }
    }


    public function createPost(Post $post) {

        // die(var_dump($post));

        $sql = "INSERT INTO cms_posts (post_title, post_content, slug, privacy, post_image, user_id)
                VALUES (:post_title, :post_content, :slug, :privacy, :post_image, :user_id)";

        $params = [":post_title" => $post->getTitle(),
                   ":post_content" => $post->getContent(),
                   ":slug" => $post->getSlug(),
                   ":privacy" => $post->getPrivacy(),
                   ":post_image" => $post->getImageId(),
                   ":user_id" => $post->getAuthor()->getId()
        ];
        App::get("db")->query($sql, $params);
        
    }

    public function editPost() {
        $sql = "UPDATE cms_posts SET post_title = :post_title, post_content = :post_content, post_image = :post_image
        WHERE post_id = :id";
    }

    public function deletePostById($postId) {
        $sql = "DELETE FROM cms_posts WHERE post_id=:post_id";
        $params = [":post_id" => $postId];
        App::get("db")->query($sql, $params);
    }

    private function validateImage() {
        // https://stackoverflow.com/a/52663580
    }

    public function uploadImages(array $images) {
        $sql = "INSERT INTO cms_images (image_id, filename, extension) VALUES
                ()";
    }

    public function createComment(Comment $comment) {
        $sql = "INSERT INTO cms_comments (comment_text, user_id, post) VALUES
        (:comment_text, :user_id, :post)";

        $params = [
            ":comment_text" => $comment->getContent(),
            ":user_id" => $comment->getAuthor()->getId(),
            ":post" => $comment->getPostId()
        ];

        App::get("db")->query($sql, $params);
    }

    public function getComments($postId) {
        $sql = "SELECT *, cms_users.* FROM cms_comments
        LEFT JOIN cms_users ON cms_users.id = cms_comments.user_id
        LEFT JOIN cms_images ON cms_users.profile_image = cms_images.image_id
        WHERE post=:post
        ORDER BY comment_date DESC";

        $params = [":post" => $postId];

        $commentdata = App::get("db")->query($sql, $params);

        foreach ($commentdata as $comment) {
            $comments[] = new Comment($comment);
        }
        // die(var_dump($comments[0]));

        return $comments ?? [];
    }
}