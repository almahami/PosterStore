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

    <!-- Font awesome http://fortawesome.github.io/Font-Awesome/-->
    <link href="../fontawesome/css/font-awesome.css" rel="stylesheet">

    <style type="text/css">

      /*
      Max width before this PARTICULAR table gets nasty
      This query will take effect for any screen smaller than 760px
      and also iPads specifically.
      */
      @media
      only screen and (max-width: 760px),
      (min-device-width: 768px) and (max-device-width: 1024px)  {

        /* Force table to not be like tables anymore */
        table, thead, tbody, th, td, tr {
          display: block;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        thead tr {
          position: absolute;
          top: -9999px;
          left: -9999px;
        }

        tr { border: 1px solid #ccc; }

        td {
          /* Behave  like a "row" */
          border: none;
          border-bottom: 1px solid #eee;
          position: relative;
          padding-left: 50%;
        }

        td:before {
          /* Now like a table header */
          position: absolute;
          /* Top/left values mimic padding */
          top: 6px;
          left: 6px;
          width: 45%;
          padding-right: 10px;
          white-space: nowrap;
        }

        /*
        Label the data
        */
        td:nth-of-type(1):before { content: "Edit"; }
        td:nth-of-type(2):before { content: "Number"; }
        td:nth-of-type(3):before { content: "Vorname"; }
        td:nth-of-type(4):before { content: "Nachname"; }
        td:nth-of-type(5):before { content: "Wohnort"; }
        td:nth-of-type(6):before { content: "Studiengang"; }
        td:nth-of-type(7):before { content: "Semester"; }
        td:nth-of-type(8):before { content: "Delete"; }
      }

      /* Smartphones (portrait and landscape) ----------- */
      @media only screen
      and (min-device-width : 320px)
      and (max-device-width : 480px) {
        body {
          padding: 0;
          margin: 0;
          width: 320px; }
        }

      /* iPads (portrait and landscape) ----------- */
      @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
        body {
          width: 495px;
        }
      }

      .container 
      {
          background: #ffffff;
      }
	  </style>

  </head>
  
  <body>

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
            

		 <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="portalview.php">Poster Store </a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="friends_overview.php">warenkorb</a></li>
              <li><a href="../friends_add.html">logout</a></li>
             
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

    	<div class="row">

        <br>
        <center><h2>Warenkorb Beirbeiten </h2></center>
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
 <?php  include_once 'setUp/footer.php' ?>

</html>

?>