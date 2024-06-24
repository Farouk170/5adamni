<?php
    // for sending mails
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
class MailSender{
    private $user_name, $password, $email_to_send_to, $subject, $msg,$email;
    public function __construct(){
        $this->email = 'cashogo.tn@gmail.com';
        $this->password = 'sznc taqr oqzc lpjk';
    }
    public function set_user_name($val){
        $this->user_name = $val;
    }
    public function get_user_name(){
        return $this->user_name;
    }
    public function set_password($val){
        $this->password = $val;
    }
    public function get_password(){
        return $this->password;
    }
    public function set_email_to_send_to($val){
        $this->email_to_send_to = $val;
    }
    public function get_email_to_send_to(){
        return $this->email_to_send_to;
    }
    public function set_email($val){
        $this->email = $val;
    }
    public function get_email(){
        return $this->email;
    }
    public function set_subject($val){
        $this->subject = $val;
    }
    public function get_subject(){
        return $this->subject;
    }
    public function set_msg($val){
        $this->msg = $val;
    }
    public function get_msg(){
        return $this->msg;
    }
    public function ResetPassword($email,$name,$date,$code){
        $Mail =  $this->get_email();
        $Password = $this->get_password();
        $mail_sender = new MailSender($Mail, $Password);
        $email_to_send_to = $email;
        $subject = "Recuperation du code de reinitialisation du mot de passe
        ";
        $msg = "Bienvenue Mr.$name,\n" .
           "Vous avez essaye de reinitialiser le mot de passe de votre compte 5adamni, le $date.\n" .
           "Pour pouvoir reinitialiser votre mot de passe, veuillez utiliser ce code: $code\n";
        $mail_send_res = $mail_sender->send_normal_mail($email_to_send_to, $subject, $msg);
        if ($mail_send_res == "mail sent") {
            //echo "Sent successfully";
        }
        else {
            return "error : " . $mail_send_res;
        }
    }
    public function generateAccountVerifyMessage($recipientName, $verificationCode, $appName){
        $verificationMessage = "Dear $recipientName,\n\n" .
            "Thank you for signing up with $appName. To verify your account, please use the following verification code:\n\n" .
            "Verification Code: $verificationCode\n\n" .
            "If you didn't sign up for $appName, please disregard this message.\n\n" .
            "Thank you,\nThe $appName Team";
        return $verificationMessage;
    }
    public function send_normal_mail($email_to_send_to, $email_subject, $email_msg){
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username =  $this->get_email(); # 'cashogo.tn@gmail.com';
            $mail->Password = $this->get_password(); # 'sznc taqr oqzc lpjk';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom($mail->Username);
            $mail->addAddress($email_to_send_to);
            $mail->isHTML(true);
            $mail->Subject = $email_subject;
            $mail->Body    = $email_msg;
            $mail->send();
            return "mail sent";
        }
        catch (Exception $e) {
            return "$mail->ErrorInfo";
        }
    }
    public function send_email($name, $date)
    {
        $Mail =  $this->get_email();
        $Password = $this->get_password();
        $mail_sender = new MailSender($Mail, $Password);
        $email_to_send_to = $this->get_email();
        $subject = "Bienvenue Mr.$name,";
        $msg = "The student with the following name $name is marked absent at $date.";
        $mail_send_res = $mail_sender->send_normal_mail($email_to_send_to, $subject, $msg);
        if ($mail_send_res == "mail sent") {}
        else {
            return "error : " . $mail_send_res;
        }
    }
}
?>