<?php

    //session_start(); in dem script, wo diesen script angewendet würde, muss ein session gestartet werden
    
    // Zufällige Code genierenern
    $string = "0123456789ABCDEFGHJIKLMNOPQRSTUVWXYZ";
    $code="";   
    for($i =0 ; $i <= 6 ; $i++){                                       // schleife 8 mal durrchlaufen
        $zufallszahl =rand(0,35);                                          // Zufallszahl generieren
        $code= substr($string, $zufallszahl, 6);                           // Ausgabe der Zufallszeichen
    }
    
    
    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';
    $mail = new PHPMailer\PHPMailer\PHPMailer();

    try {
                                                                    //Server settings

        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = "posterstore9@gmail.com" ;               //SMTP username
        $mail->Password   = 'ymckzieauyqhazub';                       //SMTP password
        $mail->CharSet ='UTF-8';

        //Recipients
        $mail->setFrom('posterstore9@gmail.com', 'POSTER STORE');
        $mail->addAddress($email, $_SESSION['firstname']. ' ' . $_SESSION['lastname']);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Bestätigungscode';                    // betreff
        $mail->Body    = 'This is the verification code: <b>' . $code .' !</b>';


        if($mail->send()){
            $_SESSION['verfication_code']=$code;               // code in session speichern 
            $_SESSION['mail_send']= "wir haben Ihnen eine Bestätigungscode per E-Mail gesendet";// resultat in session speichern
        }
        else{
            $_SESSION["error_info"]= "es gibt ein Fehler " . $mail->ErrorInfo;
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

?>