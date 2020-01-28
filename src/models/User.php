<?php

class User {
    protected $id;
    protected $name;
    protected $password;
    protected $email;
    protected $role;
    protected $registrationDate;
    protected $profileImage;
    protected $postCount;
    protected $loggedIn = false;


    public function __construct($properties)
    {
        extract($properties);


        $this->id = $id ?? "";
        $this->name = $name ?? "";
        $this->email = $email ?? "";
        $this->password = $password ?? "";
        $this->role = $role ?? "0";
        $this->roleName = $role_name ?? "";
        $this->registrationDate = $registration_date ?? "";

        $this->postCount = $post_count ?? "0";

        if (isset($profile_image)) {
            $this->profileImage = new Image($properties);
        } else {
            $this->profileImage = new Image([]);

        }
    }

    public function setLoggedIn() {
        $this->loggedIn = true;
    }
    public function isLoggedIn() {
        return $this->loggedIn;
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

    public function getPassword() {
        return $this->password;
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


    public function getPictureId() {
        return $this->profileImage->getId();
    }

    public function getProfilePicture() {
        // die(var_dump($this->profileImage));

        if (!empty($this->profileImage->getLink())) {
            return "/{$this->profileImage->getLink()}";
        }

        // Return default profile picture of none was set
        return "/img/default.svg";
    }

    public function getPostCount() {
        return $this->postCount;
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