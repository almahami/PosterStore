<?php 
    session_start();
    if($_SESSION['login'] !=111){
        header("Location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <title>Warenkorb</title>
    <!--Meta Angaben-->
    <meta charset="UTF-8">

    <meta name="author" content="MOHAMMAD AL MAHAMID">
    <meta name="creator" content="MOHAMMAD AL MAHAMID">
    <meta name="creator" content="Basel Kahrof">

    <meta name="description" content="HOME Page">

    <!-- jquery -->
    <script src="../javaScript/jquery-2.1.4.min.js"></script>

    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- Font awesome http://fortawesome.github.io/Font-Awesome/-->
    <link href="../fontawesome/css/font-awesome.css" rel="stylesheet">
    <!--nav Stylesheet-->
    <link rel="stylesheet" href="../css/nav_styles.css">
    <!-- Shop , wishlist css -->
    <link rel="stylsheet" , href="../css/shop_cart_view.css">
    <link rel="stylesheet" href="../css/dark_modus.css">
    <!--sweetalert-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 
</head>

<body>
    <!--Top navigation-->
    <?php include __DIR__.'../setUp//navbar.php'  ?>
    <!--Ende Top navigation-->
    <!--<div class="container-fluid">-->
    <div class="container">
        <!-- Static navbar -->
        <div class="row">
            <br>
            <center>
                <h2>Warenkorb </h2>
            </center>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th>Artike</th>
                        <th>Beschreibung </th>
                        <th>Preis</th>
                        <th>Anzahl</th>
                        <th><abbr title="Anzahl * Preis">Summe Preis</abbr></th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- 3 Verbindung aufbauen--->
                    <?php 
                                $userId= $_SESSION['uid'];
                                $total=0;
                                try{         
                                        $fpConnection =mysqli_connect("127.0.0.1", "root", "", "poster_store");         // DB connection 
                                        if(! $fpConnection){    	                                                    // Error  
                                            echo "Fehler: Verbindung kann nich gestellt werden"- PHP_EQL;
                                            echo "Debug Fehlernummer " . mysqli_connect_errno(). PHP_EQL;
                                            echo "Debugb Fehlernummer ". mysqli_connect.eroor(). PHP_EQL;
                                            exit;    
                                        }

                                        $sql = "SELECT products.id,userId,productId,amount,name, price,description FROM products,cart WHERE userId='$userId' AND productId= products.id";                      
                                        $result = $fpConnection->query($sql);
                                        while($row = $result->fetch_array()){
                                        
                                        ?>
                    <tr>
                        <td>
                            <?php echo $row['name'] ?>
                        </td>
                        <td>
                            <?php  echo $row['description'] ?>
                        </td>
                        <td>
                            <?php echo $row['price']; ?> &euro;
                        </td>
                        <td>
                            <?php echo $row['amount']; ?>
                            <a href="cart_edit.php?fid=<?php echo $row['id']; ?>"> <i
                                    class="fa fa-pencil fa-1x"></i></a>
                        </td>
                        <td>
                            <?php echo $row['amount']* $row['price'];?> &euro;
                        </td>

                        <td>
                            <a href="../db/delete_article.php?fid=<?php echo $row['id']; ?>"> <i
                                    class="fa fa-trash-o fa-2x"></i></a>
                        </td>   
                    </tr>  
                    <?php
                        $total+=  $row['amount']* $row['price'];
                        }
                        // db schliessen
                        mysqli_close($fpConnection);

                    }
                    catch(Exception $e){
                        echo "Fehler beim der DB Verbindung" . $e;
                    }
                    ?>
                    <tr>
                    <td><b>Summe:</b></td> 
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td><b><?php echo $total; ?> &euro; </b> </td>
                    <td> </td>
                    </tr>
                </tbody>
            </table>
            <p> <?php   $_SESSION['total']= $total; ?> </p>
        </div>
      
        <script> 
                // funktion , um den gesamten prise +  lieferkosten zu aktulisiern
                function updatetotal(){
                var oldTotal = <?php echo $total;?>;
                var newTotal=0;
                var deliveryGruppe =document.Delivery.Delivery_radios;
               
                    if(deliveryGruppe[0].checked){
                        newTotal = oldTotal + parseInt(deliveryGruppe[0].value);
                        document.getElementById('total').innerHTML = newTotal  + "&euro;";
                        return true;
                    }
                    else if(deliveryGruppe[1].checked){
                        newTotal = oldTotal + parseInt(deliveryGruppe[1].value);
                        document.getElementById('total').innerHTML = newTotal + "&euro;";
                        return true;
                    }
                    else{
                        swal("Bitte Wälen Sie eine versendart!");
                        return false;
                    }
                }
            </script>     

        <form action="../db/user_adress_savedb.php" method="post" class="form-horizontal" name="Delivery" onsubmit=" return updatetotal();">
              
            <fieldset>
                <!-- Multiple Radios -->
                <legend><b>2.Versandarten</b></legend>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="radios">Wählen Sie ein Versandart</label> <br>
                    <div class="col-md-4">
                        <div class="radio">
                            <label for="radios-0">
                                <input type="radio" name="Delivery_radios" id="Delivery_radios" value="0"  onclick="updatetotal()">
                                Normal
                            </label>
                        </div>
                        <div class="radio">
                            <label for="radios-1">
                                <input type="radio" name="Delivery_radios" id="Delivery_radios" value="4"  onclick="updatetotal()">
                                Express (+4 &euro;)

                            </label>
                        </div>
                    </div>
                </div>

            </fieldset>

            <div class="row">
                <label class="col-md-11 control-label" for="summe"> <b style="font-size:20px;">Summe  </b><b id="total"> </b> </label>
             
            </div>
                
            <fieldset>
                <legend></legend>

                <!-- Button (Double) -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="button1id"></label>
                    <div class="col-md-8">
                        <button id="checkout" name="checkout" type="submit" class="btn btn-success">zur kasse</button>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>

    <br>
    <br>
    <br>
    <hr>
    <!-- Footer -->
    <?php include_once "setUp/footer.php" ?>
    <!-- Footer -->
    </div>
</body>