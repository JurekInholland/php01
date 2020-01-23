<?php

class Comment {
    protected $id;
    protected $title;
    protected $text;
    protected $date;
    protected $author;

    public function __construct($properties)
    {
        extract($properties);

        $this->id = $comment_id;
        $this->title = $comment_title;
        $this->text = $comment_text;
        $this->date = $comment_date;
        $this->author = new User($properties);
    }


}