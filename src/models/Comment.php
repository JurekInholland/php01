<?php

class Comment {
    protected $id;
    // protected $title;
    protected $text;
    protected $date;
    protected $author;
    protected $postId;


    public function __construct($properties)
    {
        extract($properties);

        $this->id = $comment_id ?? "";
        // $this->title = $comment_title;
        $this->text = $comment_text;
        $this->date = $comment_date;

        $this->postId = $post;

        if (empty($author)) {
            $this->author = new User($properties);
        } else {
            $this->author = $author;
        }
    }

    public function getId() {
        return $this->id;
    }
    // public function getTitle() {
    //     return $this->title;
    // }
    public function getContent() {
        return $this->text;
    }
    public function getAuthor() {
        return $this->author;
    }

    public function getDate() {
        $date = new DateTime($this->date);
        return $date->format('d.m.y H:i');
    }

    public function getPostId() {
        return $this->postId;
    }
}