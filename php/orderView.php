<?php 
    session_start(); 
    if($_SESSION['login'] !=111){
        header("Location: ../index.php");
    }

    $userid = $_SESSION['uid'];

    ?>
<!DOCTYPE html>
<html lang="de">

<head>
    <title> Bestellung</title>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="author" content="MOHAMMAD AL MAHAMID">
    <meta name="creator" content="MOHAMMAD AL MAHAMID">
    <meta name="creator" content="Basel Kahrof">

    <meta name="description" content="order view">

    <!-- jquery -->
    <script src="../javaScript/jquery-2.1.4.min.js"></script>
    <!-- w3-->
    <link rel="stylesheet" href="../css/w3.css">
    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- Font awesome http://fortawesome.github.io/Font-Awesome/-->
    <link href="../fontawesome/css/font-awesome.css" rel="stylesheet">

    <!--nav Stylesheet-->
    <link rel="stylesheet" href="../css/nav_styles.css">
    <!-- Shop , wishlist css -->
    <link rel="stylsheet" , href="../css/shop_cart_view.css">
    <link rel="stylesheet" href="../db/buy_it_again.php">
    <!--sweetalert-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>

    <?php  include 'setUp/navbar.php' ?>

    <?php 
   
    try{
        $fpConnection =mysqli_connect("127.0.0.1", "root", "", "poster_store");         // DB connection 
        if(! $fpConnection){    	                                                    // Error  
            echo "Fehler: Verbindung kann nich gestellt werden"- PHP_EQL;
            echo "Debug Fehlernummer " . mysqli_connect_errno(). PHP_EQL;
            echo "Debugb Fehlernummer ". mysqli_connect.eroor(). PHP_EQL;
            exit;    
        }

        $sql ="SELECT * FROM order_ WHERE userIdFK ='$userid' ORDER BY OrderID DESC" ;
        $sql_result =$fpConnection->query($sql);
        $old_order='';
        if($sql_result){
            while($row = $sql_result->fetch_array()){
               
                $orderid = $row['OrderID'];
                
        ?>
    <section class="container">

        <div class="w3-card-4 w3-margin" style="width:80%">
            <header class="w3-container w3-light-grey">

                <div class="w3-col 12m w3-hide-small ">
                    <p> <b style="font-size:14px;"> Bestellungsnummer
                            <?php echo $row['OrderID']; ?>
                        </b>
                        <span class="w3-padding-large w3-right"> <b>Datum &nbsp;</b>
                            <?php echo $row['Bestellung_time']; ?>

                    </p>
                </div>
            </header>

            <div class="w3-container">
        
                <table class="table">
                    <thead>
                        <tr>
                            <th> </th>
                            <th>Produkt </th>
                            <th>Preis</th>
                            <th>Anzahl</th>
                            <th>Prise * Anzahl</th>
                        </tr>
                    </thead>
                    <?php 
                    $order = "SELECT products.`id`, `orderIDFK`, `productIDFK`, `amount`, name,price,image FROM `order_products`, products WHERE  OrderIDFK = '$orderid' AND products.id =productIDFK ";
                    //echo $order;
                    $order_result = $fpConnection->query($order);
                    while($product =  $order_result->fetch_array()):
                 ?>
                    <tbody>
                  
                      
                        <tr>

                            <td>
                                <img src="../images/web/<?php echo $product['image']; ?>" alt="Avatar"
                                    class="w3-left  w3-margin-right w3-margin-bottom" style="width:60px">
                            </td>
                            <td>
                                <?php echo $product['name'];?>
                            </td>
                            <td>
                                <?php echo $product['price'];  ?> <b> &euro; </b>
                            </td>
                            <td>
                                <?php echo $product['amount'] ?>
                            </td>
                            <td>
                                <?php echo $product['amount'] * $product['price'];?> <b> &euro; </b>
                            </td>

                            <td>

                            </td>
                    </tr>
                    <?php  endwhile;?>
            </tbody> 
            </table>
                      <!----->
                <form action="../db/buy_it_again.php" method="POST">
                    <input type="hidden" name="hidden_total" value="<?php echo $row["value"]; ?>" />
                    <input type="hidden" name="hidden_orderID" value="<?php echo $row["OrderID"]; ?>" />
                    <input type="hidden" name="hidden_amount" value="<?php echo $product["amount"]; ?>" />

            </div>
           
            <div class="w3-col 12m w3-hide-small ">

                <p><span class="w3-padding-large w3-right"> <b>prise in Summe
                            <?php echo $row['value'];  ?> &nbsp;
                        </b>
            </div>
           
            <button id="buy_it_again" name="buy_it_again" class="w3-button w3-block w3-dark-grey">Nocmal
                Einkaufen</button>
            </form>
           


        </div>       
        </div>
    </section>
    <?php
           
             }
        }
        mysqli_close($fpConnection);
    }catch(Exception $e){
        echo "Fehler bei DB Verbindung". $e;
    }
    ?>


</body>

<?php include 'setUp/footer.php'; ?>

</html>