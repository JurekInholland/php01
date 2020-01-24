<?php

class Post {

    protected $id;
    protected $title;
    protected $slug;
    protected $date;
    protected $image;
    protected $content;
    protected $privacy;
    protected $author;

    public function __construct($properties)
    {
        extract($properties);
        $this->id = $post_id ?? "";
        $this->title = $post_title ?? "";
        $this->content = $post_content ?? "";
        $this->content = $post_content ?? "";
        $this->privacy = $privacy ?? "";
        $this->slug = $slug ?? "";

        if (!empty($post_date)) {
            $this->date = new  DateTime($post_date);
        }

        if (!empty($image_id)) {
            $this->image = new Image($properties);
        }

        

        
        // $this->comments = $comments;
        $this->author = new User($properties);

    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function getDate() {
        return $this->date->format("d.m.Y");
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