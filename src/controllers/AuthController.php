<?php

class AuthController extends Controller {

    public function login() {
        self::view("auth/login");
    }


    public function resetPassword() {

        //https://url.nl/resetpassword?token=TOKEN_HERE&id=USER_ID
        $token = $_GET["token"];
        $id = $_GET["id"];

        if (UserService::checkPasswordToken($id, $token)) {
            UserService::loginViaToken($token);
            UserService::deletePasswordToken($token);
            return self::redirect("user/edit?id={$id}");
        }
        return self::view("partials/message", ["message" => "Token is not valid."]);


    }

    public function submitLogin() {

        // submit button was pressed
        if (!empty($_POST["submitBtn"])) {

            $_SESSION["loginMsg"] = UserService::login($_POST);

            if (empty($_SESSION["loginMsg"])) {
                // Success
                return self::redirect("");
            }

        // Forgot password button was pressed
        } else {


            $user = UserService::getUserByName($_POST["username"]);

            if (!empty($user)) {
                self::handlePasswordReset($user);
                $_SESSION["loginMsg"] = "We have sent you an email with instructions on how to reset your password.";
            }

        }
        return self::redirect("login");
    }

    private static function handlePasswordReset(User $user) {
        $token = generateUuid(32);
        UserService::addResetPasswordToken($user->getId(), $token);
        MailService::sendForgotPasswordMail($user, $token);
    }

    public function logout() {
        UserService::logout();
        return self::redirect("");
    }

    public function register() {
        self::view("auth/register");
    }

    public function submitRegister() {
        if (!empty($_POST["username"])) {

            if ($_POST["password"] == $_POST["retype_password"]) {
                $_SESSION["registerMsg"] = UserService::register($_POST);
            } else {
                $_SESSION["registerMsg"] = "Passwords do not match.";
            }

            if (empty($_SESSION["registerMsg"])) {
                // Success
                return self::redirect("");
                // return self::view("partials/goback");
            }
            return self::redirect("register");

        }
    }



    private static function verifyRecaptcha() {
        // https://gist.github.com/jonathanstark/dfb30bdfb522318fc819
        $post_data = http_build_query(
            array(
                // TODO load from config
                'secret' => "6LfHxNAUAAAAAOGuhSHB9b6azsOe7i_PFG8lLUg9",
                'response' => $_POST['g-recaptcha-response'],
                'remoteip' => $_SERVER['REMOTE_ADDR']
            )
        );
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $post_data
            )
        );
        $context  = stream_context_create($opts);
        $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
        $result = json_decode($response);
        if (!$result->success) {
            return false;
        }
        return true;
    }
}