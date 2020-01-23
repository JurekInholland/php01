<?php

class Image {
    protected $id;
    protected $filename;
    protected $extension;

    public function __construct($properties)
    {
        extract($properties);

        $this->id = $image_id;
        $this->filename = $filename;
        $this->extension = $extension;
    }

    public function getId() {
        return $this->id;
    }

    public function getExtension() {
        return $this->extension;
    }

    public function getLink() {
        return "/uploads/{$this->getId()}{$this->getExtension()}";
    }
}