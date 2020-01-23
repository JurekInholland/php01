<?php

class Post {

    protected $id;
    protected $title;
    protected $slug;
    protected $date;
    protected $image;
    protected $content;
    protected $privacy;
    protected $comments;

    public function __construct($properties)
    {
        extract($properties);

        $this->id = $post_id;
        $this->title = $post_title;
        $this->content = $post_content;
        $this->date = $post_date;
        $this->image = new Image(["image_id" => $image_id, "filename" => $filename, "extension" => $extension]);
        $this->content = $post_content;
        $this->privacy = $privacy;
        $this->slug = $slug;
        
        $this->comments = $comments;
        $this->author = new User($properties);

    }


    public function getTitle() {
        return $this->title;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function getDate() {
        return $this->date;
    }

    public function getImage() {
        return $this->image;
    }

    public function getContent() {
        return $this->content;
    }

    public function getPrivacy() {
        return $this->privacy;
    }
}