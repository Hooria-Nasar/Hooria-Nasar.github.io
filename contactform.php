<?php

use PHPMailer\PHPMailer\PHPMailer;

 require 'vendor/autoload.php';

 $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
 $dotenv->load();


//require 'phpmailer/phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer(true);

$alert = '';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['Message'];

    try {
        $mail->isSMTP();
        $mail->Host = $_ENV['HOST'];
        $mail->Port = (int)$_ENV['PORT'];
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';

        $mail->Username = $_ENV['USER'];
        $mail->Password = $_ENV['PASSWORD'];

        $mail->setFrom($email, $name);
        $mail->addAddress($_ENV['EMAIL']);

        $mail->isHTML(true);
        $mail->Subject = "learning Hub Contact Page";
        $mail->Body = "<h3>Name : $name <br> Email: $email <br> Message: $message <h3>";
        $mail->send();

        $alert = "<title>Learning Hub Pvt Limited</title>
        
        <link rel='icon'
        type='img/png' 
        href='/staging/img/favicon.png'>
        <div style='text-align: center; background-color:#2e2e2c; height:100%;'>
        <img 
        src='img/lhh.png' 
        style='width:30%;
       
        display: block;
        margin-left: auto;
        margin-right: auto;' >
        <span style='color: #eee;'> Message Sent! Thank you for contacting us.</span>
        <br>
        <br>
        <a href='index.php' style='color: #03c04a; text-decoration: none;'> Click here to go back! </a>
        </div>";
    } catch (Exception $e) {
        $alert = "<title>Learning Hub Pvt Limited</title>
        <link rel='icon'
        type='img/png' 
        href='/img/favicon.png'>
        <div style='text-align: center; background-color:#2e2e2c; height:100%;'>
        <img 
        src='img/lhh.png' 
        style='width:30%; 
        
        display: block;
        margin-left: auto;
        margin-right: auto;' >
        <span style='color: #d30c0c;'>Sorry, message not sent</span>
        <br>
        <br>
        <a href='index.php' style='color: #03c04a; text-decoration: none; '> Click here to go back!</a>
        </div>";
    }
    echo $alert;
}