<?php
    session_start();
    error_reporting();

    /*
    if($_SESSION['login'] !=111){
        header("Location: ../index.php");
    }
    */

    $search_term=$_POST['search'];
  
    try{
     $fpConnection =mysqli_connect("127.0.0.1", "root", "", "poster_store");         // DB connection 
     if(! $fpConnection){    	                                                    // Error  
         echo "Fehler: Verbindung kann nich gestellt werden"- PHP_EQL;
         echo "Debug Fehlernummer " . mysqli_connect_errno(). PHP_EQL;
         echo "Debugb Fehlernummer ". mysqli_connect.eroor(). PHP_EQL;
         exit;    
     }
     //nur verfügbare Artikel anzeigen
     $sql="SELECT id,name,description,image,price,size,item,category FROM products WHERE name LIKE '%$search_term%' OR description LIKE '%$search_term%' or category LIKE '%$search_term%'  AND item>0 ORDER BY id";
     //echo $sql;
     $result= $fpConnection->query($sql);


 ?>

<!DOCTYPE html>
<html lang="de">

<head>
    <title>Poster Store: Suche <?php echo $search_term ?></title>
    <!--Meta Angaben-->
    <meta charset="UTF-8">

    <meta name="author" content="MOHAMMAD AL MAHAMID">
    <meta name="creator" content="MOHAMMAD AL MAHAMID">
    <meta name="creator" content="Basel Kahrof">

    <meta name="description" content="search">

    <!-- jquery -->
    <script src="../javaScript/jquery-2.1.4.min.js"></script>

    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- Font awesome http://fortawesome.github.io/Font-Awesome/-->
    <link href="../fontawesome/css/font-awesome.css" rel="stylesheet">
    <!--carausel Center-->
    <link rel="stylesheet" href="../css/carausel.css">
    <!--nav Stylshet-->
    <link rel="stylesheet" href="../css/nav_styles.css">
    <!--Product Stylesheet-->
    <link rel="stylesheet" href="../css/product_styles.css">
   

    <!--sweet alert-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--Active User--->
    <script src="../javascript/active_user.js"></script>
    <script>
        function search_term(){
            var term = document.getElementById('search');
            if(term.value == 0){
                alert('Bitte geben Sie einen Suchbegiff')
            }
            
        }
    </script>
   
    
</head>

<body>
    <!--Top navigation-->
    <?php include __DIR__.'../fregment/navbar.php'  ?>
    <!--Ende Top navigation-->

    <!--Carousel-->
    <div class="container" style="width:100%; margin:0px; padding:0px">
    <div style="background-color:rgb(226, 226, 226);">

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner ">
                <div class="item active">
                    <img src="../images/carousel/carousel_1.jpg" alt="carausel" class="carausel_center">
                </div>

                <div class="item">
                    <img src="../images/carousel/carousel_2.jpg" alt="carausel" class="carausel_center">
                    <div class="carousel-caption d-none d-md-block">
                        <h5></h5>
                        <p style="color: black;">
                        </p>
                    </div>
                </div>

                <div class="item">
                    <img src="../images/carousel/carousel_3.jpg" alt="carausel" class="carausel_center">
                    <h5></h5>
                    <div class="carousel-caption d-none d-md-block">
                        <p>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    </div>
    <br>
    <!--Ende der Carousel-->

     <!--Poster list-->
     <section class="container">
        <section class="row justify-content-md-center">
            <?php if($result->num_rows >0){
                while($row =$result->fetch_array()) :?>
                    <div class="col-md-4">
                        <div class="box">
                            <div class="Product_container">
                                <div class="Product_cover">
                                    <img src="../images/web/<?php echo $row['image']; ?>" alt="">
                                </div>
                                <div>
                                <img src="../images/web/<?php echo $row['image']; ?>" alt="">
                                </div>

                            </div>

                            <form action="../db/add_item.php" method="post" align="center">
                                <h4> <?php echo $row['name']; ?></h4>
                                <p> <?php echo $row['price']; ?> &euro;</p>
                                <!-- aufgrung zeitdruck kann nicht realisiert werden 
                                <label class="col-md-2  control-label" for="size"> Größe:</label>
                                <div class="col-md-1">
                                    <select id="size" name="size" class="form-control" style="width: 80px;">
                                        <option value="Size">Size</option>
                                        <option value="21 x 30 cm"><?php echo $row['size'] ?></option>
                                        <option value="30 x 40 cm">30 x 40 cm</option>
                                        <option value="50 x 70 cm">50 x 70 cm</option>  
                                    </select>
                                </div>
                                -->
                                <div> 
                                    <label for="menge"> menge:</label>
                                    <input type="number" min="1" max="<?php echo $row['item']; ?>" value="1" name='amount' id='amount'> <br> <br>
                                    <!--Hidden Button-->
                                    <input type="hidden" name="hidden_id" value="<?php echo $row["id"]; ?>" />  
                                    <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />  
                                    <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
                                    <button type="submit" class="btn btn-info btn-sm" name="wishList">Merkliste</button>
                                    <button type="submit" class="btn btn-success btn-sm" name="add_into_card" >in den
                                        Warenkorp</button>
                                </div>
                            </form>
                                 
                        </div>
                    </div>
            <?php 
                $_SESSION['pid']=$row['id'];
                $_SESSION['name']=$row['name'];
                $_SESSION['price']=$row['price'];
                $_SESSION['time']=time();
            endwhile; 
            }else{?>
                <br>
                <h2 align="center">  <span>:) </span></h2>                
                <h3 align="center"> Leider haben wir  für die suchbegrif <i style="color:red;"> <?php echo $search_term ?> </i> keine Treffer gefunden</h3>
                <i class="bi bi-emoji-laughing-fill"></i>
           <?php 
        }
            mysqli_close($fpConnection);
        }catch(EXCEPTION $e){
            echo "Fehler bei DB verbindung". $e;
        }
            ?>
        </section>
    <!--Ende of Poster list-->
    <br>
    <!--footer-->
        <?php include_once 'fregment/footer.php'; ?>
    </div>
</body>
</html>