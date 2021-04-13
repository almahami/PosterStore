<?php 
    session_start();
    //save  value in variable 
    $userid = $_SESSION['uid'];
    $orderID  = $_POST['hidden_orderID'];
    $total = $_POST['hidden_total'];
    $amount=$_POST['hidden_amount'];
    var_dump($_POST);
    
    if(isset($_POST['buy_it_again'])){
        
        try{
            $fpConnection =mysqli_connect("127.0.0.1", "root", "", "poster_store");         // DB connection 
            if(! $fpConnection){    	                                                    // Error  
                echo "Fehler: Verbindung kann nich gestellt werden"- PHP_EQL;
                echo "Debug Fehlernummer " . mysqli_connect_errno(). PHP_EQL;
                echo "Debugb Fehlernummer ". mysqli_connect.eroor(). PHP_EQL;
                exit;    
            }

            $order_complete = FALSE;
            // Bestellung in den DB Speichern
           $bestellung_time =  date('Y-m-d'); 
            $insert_into_order= "INSERT INTO `order_`(`OrderID`, `userIdFK`, `value`, `Bestellung_time`) VALUES ('', '$userid', '$total','$bestellung_time')";
            echo $insert_into_order;
            $result_insert_into_order = $fpConnection->query($insert_into_order);
            
            if($result_insert_into_order){ 
                
                $new_order= "SELECT OrderID FROM order_ WHERE userIDFK='$userid' ORDER BY orderID DESC LIMIT 1 ";
                $result_new_order = $fpConnection->query($new_order);
               
              
                if($result_new_order){
                    while($row = $result_new_order->fetch_array()){
                        $_SESSION['new_orderID'] = $row['OrderID'];
                       
                    }
                }

                $new_OrderID=$_SESSION['new_orderID'];
            
                $order_products = "SELECT 'orderIDFK', `productIdFK`, `amount`, `OrderID`, `userIdFK`, item FROM order_, order_products,products WHERE OrderID='$orderID' AND OrderID=orderIDFK AND products.id=productIDFK AND userIdFK='$userid'";
                //echo $order_products;
                $result_order_products = $fpConnection->query($order_products);
                if ($result_order_products->num_rows > 0){

                    while($row = $result_order_products->fetch_array()){
                        $productIDFK = $row['productIdFK'];
                        $amount = $row['amount'];
                        $item=$row['item'] ;                                                                                 //Diese OrderID soll nun den nueue BestellungsID bekommen
                        $insert_into_order_products = "INSERT INTO `order_products`(`id`, `orderIDFK`, `productIDFK`, `amount`) VALUES('','$new_OrderID', '$productIDFK','$amount')";
                        echo $insert_into_order_products;
                        $result_insert_into_order_products= $fpConnection->query($insert_into_order_products);
                        $update_amount=$item - $amount;
                        if($result_insert_into_order_products){
                          
                            $query_update_aviable_item="update products SET item= '$update_amount' WHERE id='$productIDFK'";
                            $res=$fpConnection->query($query_update_aviable_item);
                            
                        }
                    }
                    $order_complete =true;
                }
               
            }   
        
           
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
                $sql ="SELECT products.id, name,amount,price,value FROM order_,order_products,products WHERE userIdFK = '$userid' AND OrderID= '$orderID' AND products.id = productIDFK AND OrderID = orderIDFK ";
                //echo $sql;
                $erg = $fpConnection->query($sql);
                while($row = $erg->fetch_array()){
    
        
                    $mail->Body .='<tr>'. '<td>' . $row['name'] .'</td>' . '<td>' . $row['price'] .   '  &euro;'.'</td>'.  '<td>' . $row['amount'] .'</td>'. '<td>' .$row['amount'] * $row['price'] .  '  &euro;'.'</td>'. '</tr>' ;   
                    
                    }
                $mail->Body.="<tr><td> <b> Summe</b></td> <td> </td> <td>  </td>  <td> <b> $total &euro; <b> </td></tr>";
                $mail->Body.="</table>";
               
                if($mail->send()){
                       header("Location: ../php/home.php");
                    }
                    
                }
        mysqli_close($fpConnection);    
               
    } catch(Exception $e){
        echo "Fehler bei der DB Verbindung". $e; 
    }
}
?>