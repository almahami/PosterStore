<?php


    //1
    session_start();
    //2 damit Nicht eingelogte  User zugriff auf die seite haben
    $userId= $_SESSION['uid'];
    if($_SESSION['login'] !=111){

        //sofort weiterleiten auf login seite
        header("Location: ../index.php");
    } 

    //var_dump($_GET);

    $productID =0;
    $userId= $_SESSION['uid'];
    $product_name ="";
    $description= "";
    $price="";
    $amount ="";
    if(isset($_GET['fid'])){
        $productID=$_GET['fid'];
    
        if($productID !=0){
        try{
                        
            $fpConnection =mysqli_connect("127.0.0.1", "root", "", "poster_store");         // DB connection 
            if(! $fpConnection){    	                                                    // Error  
                echo "Fehler: Verbindung kann nich gestellt werden"- PHP_EQL;
                echo "Debug Fehlernummer " . mysqli_connect_errno(). PHP_EQL;
                echo "Debugb Fehlernummer ". mysqli_connect.eroor(). PHP_EQL;
                exit;    
            }

            $sql = "SELECT products.id,userId,productId,amount,name, price,description,item FROM cart,products WHERE userId ='$userId' AND products.id= '$productID'";                      
            $result = $fpConnection->query($sql);
            while($row = $result->fetch_array()){
                $product_name =$row['name'];
                $description= $row['description'];
                $price= $row['price'];
                $amount =$row['amount'];
                $avilible_item= $row['item'];
            }
            mysqli_close($fpConnection);
        }catch(Excpetion $e){
            echo "Fehler bei der Verbindung". $e;
        }
    }
}
                
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="creator" content="MOHAMMAD AL MAHAMID">
    <meta name="creator" content="Basel Kahrof">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>warenkorb Bearbeiten </title>

    <!-- jquery -->
	  <script src="../javascript/jquery-2.1.4.min.js"></script>

    <!-- Bootstrap -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
 <!--nav Stylesheet-->
 <link rel="stylesheet" href="../css/nav_styles.css">
    <!-- Font awesome http://fortawesome.github.io/Font-Awesome/-->
    <link href="../fontawesome/css/font-awesome.css" rel="stylesheet">

    
	

  </head>
  
  <body>

	<!--<div class="container-fluid">-->
  <?php include __DIR__.'../fregment//navbar.php'  ?>
    <!--Ende Top navigation-->
    <!--<div class="container-fluid">-->
    <div class="container">
        <div class="page-header">
            <div class="row">
                <div class="col col-sm-2">
                  
                </div>
                <div class="col col-sm-10">
                    <h1>Poster Store </h1><h4> Warenkorb bearbeiten</h4>
                </div>
            </div>
        </div>

    	<div class="row">

        <br>
        <center><h2></h2></center>
        <br>
          <table class="table">
            <thead>
              <tr>
              
                <th>Artikle</th>
                <th>beschreibung</th>
                <th> price</th>
                <th>anzahl</th>
                <th> anzahl * Prise </th>
               
                
              </tr>
            </thead>

            <tbody>
                        <tr>
                        <td><?php echo $product_name; ?></td>
                        <td><?php  echo $description; ?></td>
                        <td><?php echo $price; ?>  &euro;</td>
                        <td> <form action="../db/update_cart.php" method="POST">
                            <input type="number" min="1" max="<?php echo $avilible_item;  ?>" value="<?php  echo $amount; ?>" name='new_amount' id='new_amount'> <br> <br>
                          
                        </td>
                        <td> <?php echo $price * $amount;  ?> </td>
                       
                       
                       
                    </tr>
            </tbody>
        </table>
        <input type="hidden" name="hidden_Product_id" value="<?php echo $productID; ?>" />  
        <button type="submit" class="btn btn-info btn-sm" name="save">Speichern</button>
        </form>
    	</div>

    </div>

    
  </body>
<br>
<br>
 <!-- Footer line-->
 <?php  include_once 'fregment/footer.php' ?>

</html>

?>