<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailService {

    public static function sendEmailChangedMail(string $oldmail, string $newmail) {
        $subject = "Your email on Pictur has been changed.";
        $body = "Your email on Pictur has just been changed from {$oldmail} to {$newmail}.";

        self::sendMail($subject, $body, $oldmail);
        self::sendMail($subject, $body, $newmail);
    }

    public static function sendForgotPasswordMail(User $user, string $token) {
        $scheme = $_SERVER['REQUEST_SCHEME'] . '://';
        $host = getenv('HTTP_HOST');

        $link = "{$scheme}{$host}/resetpassword?token={$token}&id={$user->getId()}";

        $subject = "Pictur password reset";
        $body = "To choose a new password, please click this link:<br>{$link}<br>The token will be valid for 60 minutes.";
        

        self::sendMail($subject, $body, $user->getEmail());
    }

    private static function sendMail(string $subject, string $body, string $address) {
        
        try {
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = '465';
            $mail->isHTML();
            $mail->Username = 'phpcmsjurek@gmail.com';
            $mail->Password = App::get("api")["gmail"];
            $mail->SetFrom('phpcmsjurek@gmail.com');
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AddAddress($address);
            $mail->Send();

        // Catch PHPMailer Exception
        } catch (Exception $mailException) {
            Logger::warn("Exception during sendMail: {$mailException}");
        }
        
    }
}