<?php
    session_start();
    error_reporting();
    if($_SESSION['login'] !=111){
        header("Location: ../index.php");
    }

    
    //var_dump($_POST);
    $userId= $_SESSION['uid'];
    $productId= $_POST['hidden_id'];
    $name=$_POST['hidden_name'];
    $amount=$_POST['amount'];
    $time=$_SESSION['time'];
  

    if(isset($_POST['add_into_card'])){
            try{
                $fpConnection =mysqli_connect("127.0.0.1", "root", "", "poster_store");         // DB connection 
                if(! $fpConnection){    	                                                    // Error  
                    echo "Fehler: Verbindung kann nich gestellt werden"- PHP_EQL;
                    echo "Debug Fehlernummer " . mysqli_connect_errno(). PHP_EQL;
                    echo "Debugb Fehlernummer ". mysqli_connect.eroor(). PHP_EQL;
                    exit;    
                }
                
                $insert_into_cart="INSERT INTO `cart`(`id`, `userId`, `productId`, `amount`, `time`) VALUES ('','$userId','$productId','$amount','$time');";
                echo $insert_into_cart;
                $result=$fpConnection->query($insert_into_cart);
                $_SESSION['productId']=$productId;
                mysqli_close($fpConnection);
                header("Location: ../php/home.php");

            } catch(Exception $e){
            echo "Fehler bei der DB Verbindung". $e;

            }
}
// wünshliste 
if(isset($_POST['wishList'])){
    try{
        $fpConnection =mysqli_connect("127.0.0.1", "root", "", "poster_store");         // DB connection 
        if(! $fpConnection){    	                                                    // Error  
            echo "Fehler: Verbindung kann nich gestellt werden"- PHP_EQL;
            echo "Debug Fehlernummer " . mysqli_connect_errno(). PHP_EQL;
            echo "Debugb Fehlernummer ". mysqli_connect.eroor(). PHP_EQL;
            exit;    
        }
        
        $insert_into_car="INSERT INTO `wishlist`(`id`, `userId`, `productId`) VALUES ('','$userId','$productId');";
        echo $insert_into_car;
        $result=$fpConnection->query($insert_into_car);

        mysqli_close($fpConnection);
        header("Location: ../php/home.php");

    } catch(Exception $e){
    echo "Fehler bei der DB Verbindung". $e;

    }
}
?>