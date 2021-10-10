<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//require_once ("vendor/auto_load.php");

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

//PHPMailer Object
$mail = new PHPMailer(true); //Argument true in constructor enables exceptions

print_r(error_get_last());


//From email address and name
$mail->From = "posterstore9@gmail.com";
$mail->FromName = "Full Name";

//To address and name
$mail->addAddress("posterstore9@gmail.com", "Recepient Name");



//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = "Subject Text";
$mail->Body = "<i>Mail body in HTML</i>";
$mail->AltBody = "This is the plain text version of the email content";

try {
    $mail->send();
    echo "Message has been sent successfully";
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}