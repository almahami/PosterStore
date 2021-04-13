<?php
    session_start();                                // session Satrt;
    error_reporting();
    $errors= array();
    
    //var_dump($_POST);
    
    // wenn user login anklickt                        
    if(isset($_POST['login'])){
                                        // Daten in Variablen Speichern
        $email= $_POST['email'];
        $password_hash =$_POST['password'];
        $screen_size=$_POST['screen_size'];
        $status=true;
        $LoginSuccess= false;                    // LoginSucess erstmal auf false einsetzen  
                                                //mit db verbinden
        try{

            $fpConnection = mysqli_connect('localhost', 'root', '', 'poster_store');
            if(! $fpConnection){    	                                                    // Error  
                echo "Fehler: Verbindung kann nich gestellt werden"- PHP_EQL;
                echo "Debug Fehlernummer " . mysqli_connect_errno(). PHP_EQL;
                echo "Debugb Fehlernummer ". mysqli_connect.eroor(). PHP_EQL;
                exit;
            }

            //$password_hash=hash("sha512",$password);  
            $sql ="SELECT * FROM user WHERE email='$email' AND status =true ;";        // sql query
            //echo $sql;
            $result =$fpConnection->query($sql);                                // sql query ausführen

            if($result->num_rows> 0 ){                                          //angegebene E-mail adresse und password sind richtig und konto ist bestätigt 
                
                $sql ="SELECT * FROM user WHERE email='$email' AND password='$password_hash'";
                $query=$fpConnection->query($sql);
                if($query->num_rows >0){
                    $LoginSuccess =true;                                            // login erfolgreich
                
                $online_update ="UPDATE user SET online=true, screen_size ='$screen_size' WHERE email='$email'";                                // online spalte aktulisieren
                $erg = $fpConnection->query($online_update);
                while($row = $result->fetch_array()){
                    $_SESSION['uid']=$row['id'];
                    $_SESSION['firstname']=$row['firstname'];
                    $_SESSION['lastname']=$row['lastname'];
                    $_SESSION['email']=$row['email'];
                    $_SESSION['login']=111;
                    $_SESSION['time']=time();
                }  
                //echo "Login erfolgreich" ;
               header("Location: php/home.php");            // weiterleitung zu dem home page
            }else{
                $errors['email_password_error']= "email  oder passwort stimmen nicht "; 
            }
         }
                
            else if($result->num_rows ==0){                  // email nicht vorhanden;
                //echo "email ist nicht vorhanden";
                $errors['email_error']= "email  ist nicht vorhanden"; 
            }
            else{
                $errors['email_password_error']= "email  oder passwort stimmen nicht "; 
            }
            
            mysqli_close($fpConnection);                    // Datenbank schlißen;
        }
        catch(Exception $e){

            echo "Fehler bei der DB verbindung";

        }
    }
    
/*
    if($LoginSuccess){
        header("Location: home.php");   
    }
    else{
        header("Location: index.php");   
    }
    
*/

?>