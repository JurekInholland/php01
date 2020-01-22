<?php

class User {
    protected $id;
    protected $name;

    public function __construct($properties)
    {
        extract($properties);
        
        $this->id = $id;
        $this->name = $name;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    
}