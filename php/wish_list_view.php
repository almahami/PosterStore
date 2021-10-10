<?php
  session_start();
  if($_SESSION['login'] !=111) header("Location: ../index.php");

    // verhindern, dass user auf leeren Merklsite landet
    $userIdFK = $_SESSION['uid'];
    //Sichere, dass user keine leeren Bestellung fortfährt
    try{
        $fpConnection =mysqli_connect("127.0.0.1", "root", "", "poster_store");         // DB connection 
        if(! $fpConnection){    	                                                    // Error  
            echo "Fehler: Verbindung kann nich gestellt werden"- PHP_EQL;
            echo "Debug Fehlernummer " . mysqli_connect_errno(). PHP_EQL;
            echo "Debugb Fehlernummer ". mysqli_connect.eroor(). PHP_EQL;
            exit;    
        }

        $isMerlistEmpty="SELECT * FROM wishlist WHERE userId='$userIdFK'";

        $result= $fpConnection->query($isMerlistEmpty);
        if($result->num_rows >0){

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="creator" content="MOHAMMAD AL MAHAMID">

    <meta name="creator" content="Basel Kahrof">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Merkliste </title>

    <!-- jquery -->
	  <script src="../javascript/jquery-2.1.4.min.js"></script>

    <!-- Bootstrap -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">

    <!-- Font awesome http://fortawesome.github.io/Font-Awesome/-->
    <link href="../fontawesome/css/font-awesome.css" rel="stylesheet">
      <!-- Shop , wishlist css -->
      <link rel="stylsheet" , href="../css/shop_cart_view.css">
      <!--nav Stylshet-->
      <link rel="stylesheet" href="../css/nav_styles.css">

  </head>
  
  <body>
  <?php  include '../php/fregment/navbar.php' ?>
	<!--<div class="container-fluid">-->
    <div class="container">
        <div class="page-header">
            <div class="row">
                <div class="col col-sm-2">
                  
                </div>
                <div class="col col-sm-10">
                    <h1>Poster Store </h1><h4>verwalte deine Merkliste</h4>
                </div>
            </div>
        </div>
            

		 

    	<div class="row">

        <br>
        <center><h2> </h2></center>
        <?php 
                    if(isset( $_SESSION['ERRORaricleExistInCard'])){
                        ?>
                             <div class="alert alert-danger text-center">
                                <?php echo $_SESSION['ERRORaricleExistInCard']; ?>
                            </div>
                            <?php
                    }
                    $_SESSION['ERRORaricleExistInCard']=NULL;
                    ?>
        <br>
          <table class="table">
            <thead>
              <tr>
              
                <th>Artikle</th>
                <th>beschreibung</th>
                <th>price</th>
                <th>Delete</th>
                <th>Kaufen</th>
              </tr>
            </thead>

            <tbody>
              <!-- 3 Verbindung aufbauen--->
              <?php 
                                $userId="";
                                if(isset($_SESSION['uid'])){
                                  $userId=$_SESSION['uid'];
                                }
                                $total=0;
                                try{
                                
                                        $fpConnection =mysqli_connect("127.0.0.1", "root", "", "poster_store");         // DB connection 
                                        if(! $fpConnection){    	                                                    // Error  
                                            echo "Fehler: Verbindung kann nich gestellt werden"- PHP_EQL;
                                            echo "Debug Fehlernummer " . mysqli_connect_errno(). PHP_EQL;
                                            echo "Debugb Fehlernummer ". mysqli_connect.eroor(). PHP_EQL;
                                            exit;    
                                        }

                                        $sql = "SELECT products.id,userId,productId,name, price,description FROM products,wishlist WHERE userId='$userId' AND productId= products.id";                      
                                        $result = $fpConnection->query($sql);
                                        while($row = $result->fetch_array()){
                                        
                                        ?>
                                            <tr>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php  echo $row['description'] ?></td>
                                            <td><?php echo $row['price']; ?>  &euro;</td>
                                          
                                            <td>
                                            <a href="../db/delete_artikle_wishList.php?pid=<?php echo $row['id']; ?>" > <i class="fa fa-trash-o fa-2x"></i></a>
                                            </td>
                                            <td>
                                            <a href="../db/insert_artikle_wishList_into_card.php?pid=<?php echo $row['id']; ?>" > <i class="fa fa-shopping-cart  fa-2x"></i></a>
                                            </td>
                                        </tr>

                                        
                                    <?php
                                      
                                        }
                                        // db schliessen
                                        mysqli_close($fpConnection);

                                    }
                                    catch(Exception $e){
                                        echo "Fehler beim der DB Verbindung" . $e;
                                    }

                
                    ?>
            
            
            </tbody>
        </table>
    		
    	</div>

    </div>

    <?php include 'fregment/footer.php';  ?>
  </body>  
</html>

<!-- Ende der try Block, dient dazu, dass user keine Leeren Bestellung gibt-->
<?php
    }
   else {
      
        $_SESSION["emptyMerklist"]="Ihre Wünschliste ist noch Leer!";
        header("Location: home.php");
    }
//try close
    }
    catch(Exception $e){
        echo "Fehler bi db verbindung". $e;
    }
?>