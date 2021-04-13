
<?php
   session_start();
   
    try{
        $fpConnection =mysqli_connect("127.0.0.1", "root", "", "poster_store");         // DB connection 
        if(! $fpConnection){    	                                                    // Error  
            echo "Fehler: Verbindung kann nich gestellt werden"- PHP_EQL;
            echo "Debug Fehlernummer " . mysqli_connect_errno(). PHP_EQL;
            echo "Debugb Fehlernummer ". mysqli_connect.eroor(). PHP_EQL;
            exit;    
        }

        $userid = $_SESSION['uid'];
        // online status ändern
        $sql_online_column_updaten =  "UPDATE user SET online=false WHERE id= '$userid'";
        $result_online_column_updaten =  $fpConnection->query($sql_online_column_updaten);    

        if($result_online_column_updaten){
            //Initalisierung der Session
            // wenn die session_name ('irgendwas') verwenden,vergessen sie es 
            // jestzt nicht
            //löschen aller Session Variblen
            $_SESSION = array();
            //falls die Session gelöscht werden soll, löschen sie 
            // auch das Cookie
            //Achtung: Damit  wird die Session gelöscht, nicht nur session Datein
            if(ini_get("session.use_cookies")){
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time()-42000,$params["path"],
                                                $params["domain"], $params["secure"], $params["httponly"]);
        }
        //zum schluss
        session_destroy();
        
        }else{
            echo "Fehler";
        }
        

    }catch(Exception $e){
        echo "Fehler bei der Verbindung". $e;
    }
?>


<html lang="de">
    <head>
        <title> Logout</title>
        <meta charset="utf-8">
        <meta name="author" content="Mohammad AL Mahamid">
        <meta name="creator" content="MOHAMMAD AL MAHAMID">
        <meta name="creator" content="Basel Kahrof">
        <meta name="description" content="Logout page">

         <!-- jquery -->
    <script src="../javaScript/jquery-2.1.4.min.js"></script>

    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- Font awesome http://fortawesome.github.io/Font-Awesome/-->
    <link href="fontawesome/css/font-awesome.css" rel="stylesheet">
    
    <!--nav Stylesheet-->
    <link rel="stylesheet" href="../css/nav_styles.css">
    <!--Logout stylesheet-->
    <link rel="stylesheet" href="../css/logout.css">

</head>
   
    <body>
         <!--Top navigation-->
    <nav class="navbar navbar-light" style="background-color: #e3f2fd; margin-bottom: 0%;">
        <a class="navbar-brand" href="../index.php"> Poster Store</a>
      

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

        </div>

    </nav>
    <!--Ende Top navigation-->
        
        <!--Conntent-->
        <section > 
        <p style="text-align: center;"> Vielen Dank für Ihre Besuch</p>
        <p> wir Höffen  das Ihnen bald wiedersehen</p>
        </section>
        <!--ende Content-->

    
        <hr>
      <!-- Footer line-->
        <?php  include 'setUp/footer.php' ?>
    </body>


</html>