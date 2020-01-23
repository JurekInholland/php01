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


}