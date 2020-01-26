<?php

class Image {
    protected $id;
    protected $filename;
    protected $extension;

    public function __construct($properties)
    {
        extract($properties);

        $this->id = $image_id ?? generateUuid(16);
        $this->filename = $filename ?? "";
        $this->extension = $extension ?? pathinfo(self::getFilename(), PATHINFO_EXTENSION);
    }

    public function getId() {
        return $this->id;
    }

    public function getFilename() {
        return $this->filename;
    }

    public function getExtension() {
        return $this->extension;
    }

    public function getLink() {
        if (!empty($this->id) && !empty($this->getExtension())) {
            return "uploads/{$this->getId()}.{$this->getExtension()}";
        }
    }
}