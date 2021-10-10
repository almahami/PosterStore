

    <!--Top navigation-->
    <nav class="navbar navbar-light" style="background-color: #e3f2fd; margin-bottom: 0%;">
        <a class="navbar-brand" href="#"> Poster Store</a>
        <p class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <?php  if (isset($_SESSION['firstname']) & isset($_SESSION['lastname'])) echo "Hello <b>". $_SESSION['firstname'] . " ". $_SESSION['lastname'] . "</b> !"?>
            <?php  if (isset($_SESSION['lastTimeChange'])){ echo "Sie Waren zuletzt am <b>".$_SESSION['lastTimeChange']. " online </b>";} else{ echo ""; } ?>
        </p>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="orderView.php">Bestellungen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="help.php">Help</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="../index.php" tabindex="-1" aria-disabled="true">Login</a>
                </li>
                <!--<li class="nav-item">
                    <a class="nav-link disabled" href="logout.php" tabindex="-1" aria-disabled="true">Logout</a>
                </li>
                -->

                <li class="nav-item">
                <form class="form-inline my-2 my-lg-0" method="POST" action="search.php" onsubmit="search_term()">
                    <input class="form-control mr-sm-1"  type="search"  name="search" id="search" placeholder="Suche" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" style="float: right;" type="submit">suche</button>
                </form>

                </li>
                <li class="nav-item" >
                    <span> <abbr title="Merkliste"><a href='wish_list_view.php'><i class="fa fa-heart fa-2x">
                        <sup> 
                            <?php  
                                 $userid= "";
                                 if(isset($_SESSION['uid'])){
                                     $userid = $_SESSION['uid'];
                                 //}
                                try{
                                    $fpConnection =mysqli_connect("127.0.0.1", "root", "", "poster_store");         // DB connection 
                                    if(! $fpConnection){    	                                                    // Error  
                                        echo "Fehler: Verbindung kann nich gestellt werden"- PHP_EQL;
                                        echo "Debug Fehlernummer " . mysqli_connect_errno(). PHP_EQL;
                                        echo "Debugb Fehlernummer ". mysqli_connect.eroor(). PHP_EQL;
                                        exit;    
                                    }
                                
                                    $wish_list_item_sql="SELECT COUNT(*) FROM wishlist  WHERE userId=$userid";
                                    //echo $sql;
                                    $wish_list_resultat= $fpConnection->query($wish_list_item_sql);

                                    $wish_listItem = $wish_list_resultat->fetch_row()[0];
                                    echo $wish_listItem;
                                    mysqli_close($fpConnection);
                                }
                                catch(Exception $e){
                                    echo "Fehler bei DB Verbindug". $e;
                                }
                            }
                                ?>     
                                   
                        </sup>
                    </i></a></abbr></span>
                </li>
                <li class="nav-item" >                                                                      
                    <span> <abbr title="Einkaufswagen"> <a href='cartView.php'><i class="fa fa-shopping-cart fa-2x"> 
                            <sup> <?php
                                     
                                    $userid= "";
                                    if(isset($_SESSION['uid'])){
                                        $userid = $_SESSION['uid'];
                                    
                                  //<!-- Anzahl der Akteullen Artikel in den Warenkorb-->
                                    try{        
                                        $fpConnection =mysqli_connect("127.0.0.1", "root", "", "poster_store");         // DB connection 
                                        if(! $fpConnection){    	                                                    // Error  
                                            echo "Fehler: Verbindung kann nich gestellt werden"- PHP_EQL;
                                            echo "Debug Fehlernummer " . mysqli_connect_errno(). PHP_EQL;
                                            echo "Debugb Fehlernummer ". mysqli_connect.eroor(). PHP_EQL;
                                            exit;    
                                        }
                                    
                                        $cart_item_sql="SELECT COUNT(*) FROM cart  WHERE userId=$userid";
                                        //echo $sql;
                                        $cart_resultat= $fpConnection->query($cart_item_sql);

                                        $cartItem = $cart_resultat->fetch_row()[0];
                                        echo $cartItem;
                                    }
                                    catch(Exception $e){
                                        echo "Fehler bei DB Verbindug". $e;
                                    }
                                }
                                    ?>
                                </sup> </i> </a></abbr>
                                </span>
                </li>
               
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                        aria-expanded="false"><span><abbr title="Account"><i
                                    class="fa fa-user fa-2x"></i></abbr></span></a>
                    <ul class="dropdown-menu" role="menu">
                       <!-- <li> <a href="account_barbeiten.php">Account barbeiten</a></li>-->
                        <li><a href="../index.php">Login</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>
                <li class="nav-item" style="float:right;" >
                    <!--anzahl der Aktiven User-->
                    <p>Aktiven User: <b id="active_user">
                    <?php if(isset( $_SESSION['active_user'])) echo $_SESSION['active_user']; else{ echo 0;}  ?>

                        </b></p>
                </li>
                                    
               
            </ul>
        </div>
        </div>
    </nav>

    <!--Ende Top navigation-->