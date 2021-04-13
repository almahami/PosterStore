<?php

    session_start();
    //2 zugäng nur für angemeldeten Nutzer
    if($_SESSION['login'] !=111){

        //sofort weiterleiten auf login seite
        header("Location: ../index.php");
    } 

    var_dump($_GET);

    $userId=$_SESSION['uid'];
    $productID=0;

    if(isset($_GET['pid'])){
        $productID= $_GET['pid'];
    }

    if($productID !=0){
        try{
                            
            $fpConnection =mysqli_connect("127.0.0.1", "root", "", "poster_store");         // DB connection 
            if(! $fpConnection){    	                                                    // Error  
                echo "Fehler: Verbindung kann nich gestellt werden"- PHP_EQL;
                echo "Debug Fehlernummer " . mysqli_connect_errno(). PHP_EQL;
                echo "Debugb Fehlernummer ". mysqli_connect.eroor(). PHP_EQL;
                exit;    
            }
            $insert_into_cart="INSERT INTO `cart`(`id`, `userId`, `productId`, `amount`) VALUES ('','$userId','$productID','1');";
            echo $insert_into_cart;
            $result_insert_into_cart=$fpConnection->query($insert_into_cart);
            
            if($result_insert_into_cart){
                $delete_product_from_wishlist = "DELETE FROM wishlist WHERE productId=" . $productID." ";
                $result_delete_product_from_wishlist= $fpConnection->query($delete_product_from_wishlist);
                
                if($result_delete_product_from_wishlist){
                    header("Location: ../php/home.php");
                }
                else{
                    echo "Fehler beim Löschen";
                }
                
           
            }else{
                echo "Fehler beim Einfügen in den Warenkorb";
            }
            mysqli_close($fpConnection);
        }catch(Exception $e){
            echo "Fehler bei der Verbindung". $e;
    }
}


            


?>