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
        $this->privacy = $privacy ?? "";
        $this->slug = $slug ?? "";

        if (!empty($post_date)) {
            $this->date = new DateTime($post_date);
        } else {
            $this->date = new DateTime();
        }

        if (!empty($image_id)) {
            $this->image = new Image($properties);
        } else {
            $this->image = new Image([]);
        }

        

        
        // $this->comments = $comments;
        $this->author = $author ?? new User($properties);

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

    public function getDateAndTime() {
        return $this->date->format("d.m.Y H:i:s");

    }

    public function getImage() {
        return $this->image;
    }

    public function getImageId() {
        return $this->image->getId();
    }

    public function getContent() {
        return $this->content;
    }

    public function getPrivacy() {
        return $this->privacy;
    }

    public function getEditLink() {
        $url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/edit?post={$this->getSlug()}";
        return stripslashes($url);
    }

    public function getViewLink() {
        $url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/view?post={$this->getSlug()}";
        return stripslashes($url);
    }

    public function getPdfLink() {
        $url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/pdf?post={$this->getSlug()}";
        return stripslashes($url);
    }

    public function getData() {
        return [
            "id" => $this->getId(),
            "title" => $this->getTitle(),
            "content" => $this->getContent(),
            "date" => $this->getDateAndTime(),
            "image_id" => $this->getImage()->getId() ?? "",
            "author" => $this->getAuthor()->getName(),
            "link" => $this->getViewLink()
        ];
    }

    public function getQrCode(string $size="500x500") {
        $url = $this->getViewLink();
        return ('https://chart.googleapis.com/chart?cht=qr&chld=H|1&chs='.$size.'&chl='.urlencode($url));
    }
}