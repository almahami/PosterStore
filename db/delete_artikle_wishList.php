<?php

    session_start();
    //2 zugäng nur für angemeldeten Nutzer
    if($_SESSION['login'] !=111){

        //sofort weiterleiten auf login seite
        header("Location: ../index.php");
    } 

    var_dump($_GET);

    $productID =0;

    if(isset($_GET['pid'])){
        $productID=$_GET['pid'];
      
        if($productID !=0){
            try{
                                
                $fpConnection =mysqli_connect("127.0.0.1", "root", "", "poster_store");         // DB connection 
                if(! $fpConnection){    	                                                    // Error  
                    echo "Fehler: Verbindung kann nich gestellt werden"- PHP_EQL;
                    echo "Debug Fehlernummer " . mysqli_connect_errno(). PHP_EQL;
                    echo "Debugb Fehlernummer ". mysqli_connect.eroor(). PHP_EQL;
                    exit;    
                }

                $delete_sql= "DELETE FROM wishlist WHERE productId=" . $productID." ";

                $result= $fpConnection->query($delete_sql);
                if($result===true){
                    echo "Super, Löschen hat geklappt";
                    header("Location: ../php/wish_list_view.php");
                }
                else{
                    echo "Fehler beim Löschen des DS". $fpConnection->error;
                }
        }catch(Exception $e){
            echo "Fehler bei der Verbindung". $e;
        }
    }
    }

?>