<?php

    session_start();
    error_reporting();
//    var_dump($_POST);

    $first_name="";
    $last_name="";
    $email="";
    $password="";
    $errors=array();
    $singUpSucess=false;
    $status=false;
    if(isset($_POST['singUp'])){
        // daten in variablen Speichern 
        if(isset($_POST['firstname'])){
            $first_name=$_POST['firstname'];
        }

        if(isset($_POST['lastname'])){
            $last_name=$_POST['lastname'];
        }

        if(isset($_POST['email'])){
            $email=$_POST['email'];
        }

        if(isset($_POST['password'])){
            $password_hash=$_POST['password'];
        }
            $fpConnection =mysqli_connect("127.0.0.1", "root", "", "poster_store");         // DB connection 
            if(! $fpConnection){    	                                                    // Error  
                echo "Fehler: Verbindung kann nich gestellt werden"- PHP_EQL;
                echo "Debug Fehlernummer " . mysqli_connect_errno(). PHP_EQL;
                echo "Debugb Fehlernummer ". mysqli_connect.eroor(). PHP_EQL;
                exit;    
            }

            $email_check ="SELECT * FROM `user` WHERE email ='$email';";                  // selektiere alle email  mit dem angegebenen email adresse
            //echo $email_check;
            $res = $fpConnection->query($email_check);
            // echo mysqli_num_rows($res);
            //echo "<br>";
            if($res->num_rows> 0 ){                                                     // teste ob email schon registiert
            
                $singUpSucess=false;
                $errors['email'] = "angegebene Email ist schon registiert";             // füge eine Error in der liste errors 
                // hier sollte die Nutzer die Fehler sehen Können
            }
            if(count($errors) ===0 ){                                                    // keine Errors bzw. Errors list is empty 
                $singUpSucess =true; 
                                                                                        // if registierung erfolgreich war bestätigungscode senden 
             if($singUpSucess){                                                       // vertfication code senden                                     
                 
                  require ('sent_verfication_code.php');                         //php script, um eine bestätigungscode zu senden 
                }
                    $_SESSION['firstname']=$first_name;
                    $_SESSION['lastname']=$last_name;
                    $_SESSION['email']= $email;                                                        //email in session speichern 
                    $_SESSION['status']=$status;
                    $_SESSION['errors']=$errors;
                    $_SESSION['registiert']=111;
                                
                    //$password_hash=hash("sha512",$password);                                             //password_hash with php     
                    $insert = "INSERT INTO `user` (id, firstname,lastname, email,password,verification_code ,status,online) VALUES('','$first_name', '$last_name','$email','$password_hash','$code',false,false);"; // füge neue Daten satz 
                    //echo $insert;
                    $result =$fpConnection->query($insert);
                    //echo "Neuer Kunde ist da";
                    header("Location: verification.php");
                }   
      mysqli_close($fpConnection);

      
    }
?>