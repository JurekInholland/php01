<?php

class AuthController extends Controller {

    public function login() {
        self::view("auth/login");
    }

    public function submitLogin() {
        die(var_dump($_POST));
    }

    public function logout() {

    }

    public function register() {

    }
}