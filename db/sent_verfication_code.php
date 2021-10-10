<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//require_once ("vendor/auto_load.php");

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
    //session_start(); in dem script, wo diesen script angewendet würde, muss ein session gestartet werden
    // Zufällige Code genierenern
    $code=rand(1111,99999);  
  
    $mail = new PHPMailer(true);
    try {
        //Server settings
        //Recipients
        $mail->From = "posterstore9@gmail.com";
        $mail->FromName = "Poster Store ";
        $mail->addAddress($_SESSION['email'],$_SESSION['firstname']);
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Bestätigungscode';                    // betreff
        $mail->Body    = 'This is the verification code: <b>' . $code .' !</b>';
        //var_dump($mail);
        if($mail->Send()){
            $_SESSION['verfication_code']=$code;               // code in session speichern 
            echo "Code ::::::::::". $code;
            echo $_SESSION['verfication_code'];
            $_SESSION['mail_send']= "wir haben Ihnen eine Bestätigungscode per E-Mail gesendet";// resultat in session speichern


        echo "_______________________SENT IT BABY_______________________ ";

        }
        else{
            $_SESSION["error_info"]= "es gibt ein Fehler " . $mail->ErrorInfo;
        echo "_______________________SENT IT BABY_______________________ ";

        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
?>