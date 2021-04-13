<?php
     //1
     session_start();
     //var_dump($_POST);
     
     //2
     if($_SESSION['login'] != 111){
         header("Location: ../index.php");
     }

     $n_amount="";
     $productID="";

     if(isset($_POST['new_amount'])){
         $n_amount =$_POST['new_amount'];

     }
     if(isset($_POST['hidden_Product_id'])){
         $productID = $_POST['hidden_Product_id'];
     }
     try{

        $fpConnection = mysqli_connect('localhost', 'root', '', 'poster_store');
        if(! $fpConnection){    	                                                    // Error  
            echo "Fehler: Verbindung kann nich gestellt werden"- PHP_EQL;
            echo "Debug Fehlernummer " . mysqli_connect_errno(). PHP_EQL;
            echo "Debugb Fehlernummer ". mysqli_connect.eroor(). PHP_EQL;
            exit;
        }

        $update_sql = "UPDATE  cart SET amount= $n_amount WHERE cart.productId= '$productID'";
        $result =$fpConnection->query($update_sql);

        if($result ===true){
            echo "Update success";
            header("Location: ../php/cartView.php ");
        }
        else{
            echo "update Error";
        }
     }catch(Exception $e){

        echo "Fehler bei der verbindung ". $e;
     }




?>