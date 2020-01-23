<?php

class User {
    protected $id;
    protected $name;
    protected $password;
    protected $email;
    protected $role;
    protected $registrationDate;
    protected $profileImage;


    public function __construct($properties)
    {
        extract($properties);
        
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->registrationDate = $registration_date;
        $this->profileImage = $profile_image;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    
}