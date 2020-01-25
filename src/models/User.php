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


        $this->id = $id ?? "";
        $this->name = $name ?? "";
        $this->email = $email ?? "";
        $this->password = $password ?? "";
        $this->role = $role ?? "";
        $this->roleName = $role_name ?? "";
        $this->registrationDate = $registration_date ?? "";
        if (isset($profile_image)) {
            $this->profileImage = new Image($properties);
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getNameCapitalized() {
        return ucfirst($this->name);
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRole() {
        return $this->role;
    }

    public function getRoleName() {
        return $this->roleName;
    }
    
    public function getRegistrationDate() {
        return $this->registrationDate;
    }

    public function getData() {
        return [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "email" => $this->getEmail(),
            "role" => $this->getRole(),
            "registration_date" => $this->getRegistrationDate(),
        ];
    }
}