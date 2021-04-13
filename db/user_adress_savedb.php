<?php

session_start();
if($_SESSION['login'] !=111){
    header("Locaton: ../index.php");
}

   var_dump($_POST);

   $total=$_SESSION['total'];
   $userid = $_SESSION['uid'];
   if(isset($_POST['checkout'])){
    if(isset($_POST['Delivery_radios'])){
        $delivery_cost=$_POST['Delivery_radios'];
        $_SESSION['delivery_cost']=$_POST['Delivery_radios'];
         
    }
        try{
            
            $fpConnection =mysqli_connect("127.0.0.1", "root", "", "poster_store");         // DB connection 
            if(! $fpConnection){    	                                                    // Error  
                echo "Fehler: Verbindung kann nich gestellt werden"- PHP_EQL;
                echo "Debug Fehlernummer " . mysqli_connect_errno(). PHP_EQL;
                echo "Debugb Fehlernummer ". mysqli_connect.eroor(). PHP_EQL;
                exit;    
            }

            $sql ="SELECT 'id',`userIdFK` `plz`, `street`, `city`, `country` FROM user, user_adress WHERE userIdFK ='$userid';";
            //echo $sql;
            $erg = $fpConnection->query($sql);
            if($erg){
                while($row = $erg->fetch_array()){
                    $_SESSION['plz']= $row['plz'];
                    $_SESSION['street']= $row['street'];
                    $_SESSION['city']= $row['city'];
                    $_SESSION['country']= $row['country'];
                }
                header("Location: ../php/user_adress.php");
            }else{
                echo "Fehler";
            }
            mysqli_close($fpConnection);

        }catch(EXCEPTION $e){
        echo "Fehler bei der verbindung". $e;
        }
    }

    $delivery_cost=$_SESSION['delivery_cost'];
    $update_total= $total + $delivery_cost;
    //echo $update_total;
    // wenn user seine Adress Aktulisiert bzw zum ersten mal eingibt 
    if (isset ($_POST['order'])){
       
        //adresse user x speichern bzw. aktulisiern
        //var_dump($_POST);
        $save_adresse= false;
        $order_complete = false;
        $anrede =$_POST['radios'];
        $firstname =$_POST['firstname'];
        $lastname= $_POST['lastname'];
        $plz = $_POST['plz'];
        $street = $_POST['street'];
        $city = $_POST['city'];
        $country=  $_POST['country'];
        try{
            
            $fpConnection =mysqli_connect("127.0.0.1", "root", "", "poster_store");         // DB connection 
            if(! $fpConnection){    	                                                    // Error  
                echo "Fehler: Verbindung kann nich gestellt werden"- PHP_EQL;
                echo "Debug Fehlernummer " . mysqli_connect_errno(). PHP_EQL;
                echo "Debugb Fehlernummer ". mysqli_connect.eroor(). PHP_EQL;
                exit;    
            }
            // teste ob, user x hat schon eine Adrsse gespeichert
            $select_user_adress="SELECT * FROM user,user_adress WHERE user.id=userIdFK";
            echo $select_user_adress .  '<br>' ;
            $result_select_user_adress  =$fpConnection->query($select_user_adress);

            // adresse Aktulisieren
            if($result_select_user_adress->num_rows > 0){
                $sql="UPDATE user_adress SET firstname= '$firstname', lastname='$lastname', plz='$plz', street='$street', city='$city',country= '$country' "; 
                //echo $sql .  '<br>' ;
                $result = $fpConnection->query($sql);
                if($result){
                    $save_adresse=true;
                   // header("Location: ../php/user_adress.php");
                }
            }
            // adresse Speichern
            else{
                $insert_into_user_adress= "INSERT INTO user_adress(`id`, `userIdFK`, `anrede`, `firstname`, `lastname`, `plz`, `street`, `city`, `country`) VALUES('','$userid', '$anrede', '$firstname', '$lastname', '$plz', '$street', '$city', '$country');";
                $result_insert_into_user_adress= $fpConnection->query($insert_into_user_adress);
                if($result_insert_into_user_adress){
                    $save_adresse=true;
                    header("Location: ../php/user_adress.php");

                }
            }
            // wenn adresse erfolgreich gespeichert bzw. aktulisiert fortfahren mit der Bestellung prozess
            if($save_adresse){

                // Bestellung in den DB Speichern 
                $bestellung_time =  date('Y-m-d');
                $insert_into_order= "INSERT INTO `order_`(`OrderID`, `userIdFK`, `value`, `Bestellung_time`) VALUES ('', '$userid', '$update_total', '$bestellung_time')";
                echo $insert_into_order;
                $result_insert_into_order = $fpConnection->query($insert_into_order);
                
                $orderIDFK='';
                if($result_insert_into_order){
                    
                    $orderIDFK_auslesen = "SElECT OrderID FROM order_ WHERE userIdFK ='$userid' ";
                    $orderIDFK_auslesen_result = $fpConnection->query($orderIDFK_auslesen);
                    if($orderIDFK_auslesen_result){
                    while($row = $orderIDFK_auslesen_result->fetch_array()){
                        $orderIDFK=$row['OrderID'];
                        //echo $orderIDFK;
                    }
                 
                    $order_products = "SELECT `userId`, `productId`, `amount`,item FROM cart,products WHERE userId ='64' AND productId=products.id";
                   // echo $order_products .  '<br>' ;
                    $result_order_products = $fpConnection->query($order_products);
                    $productIDFK=0;
                    if ($result_order_products->num_rows > 0){

                        while($row = $result_order_products->fetch_array()){

                            $item=$row['item'];
                            $productIDFK = $row['productId'];
                            $amount = $row['amount'];
                            $update_item = $row['item'] - $row['amount'];
                        
                            //$update_item = $item - $amount;
                            $insert_into_order_products = "INSERT INTO `order_products`(`id`, `orderIDFK`, `productIDFK`, `amount`) VALUES('','$orderIDFK', '$productIDFK','$amount')";
                            //echo $insert_into_order_products.  '<br>' ;
                            $result_insert_into_order_products= $fpConnection->query($insert_into_order_products);
                            if($result_insert_into_order){
                                $query_update_aviable_item="update products SET item= '$update_item' WHERE id='$productIDFK'";
                                $res=$fpConnection->query($query_update_aviable_item);
                            }
                        }
                        
                    }
                }
                }else{
                    echo "Fehler beim Einfügen Product in die Bestellungtable ";
                }
                $order_complete=true;
                    if($order_complete){

                         // E-Mail Bestätigungern Senden 
                        require '../PHPMailer/src/Exception.php';
                        require '../PHPMailer/src/PHPMailer.php';
                        require '../PHPMailer/src/SMTP.php';
                        $mail = new PHPMailer\PHPMailer\PHPMailer();
                        
                        $mail_content= 'Hallo ' .  $_SESSION['firstname'] . ' ' . $_SESSION['lastname']. ' !</br>'. '<p> hiermit erhalten sie eine Übersicht über Ihre Bestellung: </p> <br>';
                        
                                                                                    //Server setting
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = "posterstore9@gmail.com" ;               //SMTP username
                        $mail->Password   = 'ymckzieauyqhazub';                       //SMTP password
                        $mail->CharSet ='UTF-8';

                        //Recipients
                        $mail->setFrom('posterstore9@gmail.com', 'POSTER STORE');
                        $mail->addAddress($_SESSION['email'], $_SESSION['firstname']. ' ' . $_SESSION['lastname']);     //Add a recipient

                        //Content
                        $mail->isHTML(true);                               //Set email format to HTML
                        $mail->Subject = 'Bestellung';                    // betreff
                        $mail->Body.=$mail_content;
                        $mail->Body.=" <table> <tr> <th>name </th> <th>price </th> <th>menge </th> <th>summe </th> </tr>";
                        // Inhalt  des bestätigungsmail geniereernen
                        $sql ="SELECT cart.id, name,amount,price FROM cart,products WHERE userId = '$userid' AND cart.productId=products.id";
                        //echo $sql;
                        $erg = $fpConnection->query($sql);
                        while($row = $erg->fetch_array()){

                            $mail->Body .='<tr>'. '<td>' . $row['name'] .'</td>' . '<td>' . $row['price'] .   '  &euro;'.'</td>'.  '<td>' . $row['amount'] .'</td>'. '<td>' .$row['amount'] * $row['price'] .  '  &euro;'.'</td>'. '</tr>' ;   
                        
                        }
                        $mail->Body.="<tr><td> <b> Summe</b></td> <td> </td> <td>  </td>  <td> <b> $update_total &euro; <b> </td></tr>";
                        $mail->Body.="</table>";

                    }else{
                        echo "Fehler bei Bestellung Prozess"; 
                    }
                    
                // shopping cart leeren
                
                if($order_complete  && $mail->send()){
                    $sql = "DELETE  FROM cart WHERE userId = '$userid'";
                    $res = $fpConnection->query($sql);
                    // bei neuer Bestellung, wert neue einsetzen
                    header("Location: ../php/home.php");
                }
            }          
            mysqli_close($fpConnection);
        }catch(Exception $e){
            echo "Fehler bei der DB Verbindung". $e; 
        }
    }

    if(isset($_POST['cancel'])){
        header("Location: ../php/home.php");
    }

?>