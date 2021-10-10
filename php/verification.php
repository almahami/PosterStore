<?php
    session_start();
    error_reporting();

   // if( $_SESSION['registiert'] !=111){
   //     header("Location: singUp_formular.php");
   // }
    //var_dump($_POST);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Riegistierung Bestätigen</title>
    <!--Meta Angaben-->
    <meta charset="UTF-8">

    <meta name="author" content="MOHAMMAD AL MAHAMID">
    <meta name="creator" content="MOHAMMAD AL MAHAMID">
    <meta name="creator" content="Basel Kahrof">

    <meta name="description" content="Singup Bestätigen">

    <!-- jquery -->
    <script src="../javaScript/jquery-2.1.4.min.js"></script>

    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- Font awesome http://fortawesome.github.io/Font-Awesome/-->
    <link href="../fontawesome/css/font-awesome.css" rel="stylesheet">
    <!--nav Stylesheet-->
    <link rel="stylesheet" href="../css/nav_styles.css">
    <style type="text/css">
        .im-centered {
            margin: auto;
            max-width: 600px;
        }
    </style>
    
    <!--Valideren Der Daten mit JavaScript-->
    <script>
        function daten_validieren() {
            var username = document.loginform.username;
            var password = document.loginform.verification_code;
            //alert(username.value);

            if (username.value.length == 0) {
                alert("Bitte geben Sie ein Username ein! ")
                return false;
            }
            if (verification_code.value.length == 0) {
                alert("Bitte geben Sie die Bestätigungscode ein! ")
                return false;
            }

        }
    </script>
</head>

<body>
    <nav class="navbar navbar-light" style="background-color: #e3f2fd; margin-bottom: 0%;">
        <a class="navbar-brand" href="home.php" style="margin-left: 300px;"> Poster Store</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-3">
                <li class="nav-item" style=" margin-left: 500px;">
                    <h2 style="text-align: center;"> </h2>
                </li>
            </ul>
        </div>
    </nav>
    <!--Ende der Top -->

    <?php
            $errors=array();
           
            if(isset($_POST['bestaetigen']) || isset($_POST['resent_code'])){
                //var_dump($_POST);
                $email=$_POST['username'];
                $verf_code =$_POST['verification_code'];
           
                try{

                    $fpConnection =mysqli_connect("127.0.0.1", "root", "", "posteR_store");         // DB connection 
                    if(! $fpConnection){    	                                                    // Error  
                        echo "Fehler: Verbindung kann nich gestellt werden"- PHP_EQL;
                        echo "Debug Fehlernummer " . mysqli_connect_errno(). PHP_EQL;
                        echo "Debugb Fehlernummer ". mysqli_connect.eroor(). PHP_EQL;
                        }
                        
                    if(isset($_POST['bestaetigen'])){                                               //user bestätigt sein Mail
                            if($email == $_SESSION['email'] && $verf_code == $_SESSION['verfication_code']){
                                $update_status ="UPDATE `user` SET status=true ,online=false WHERE email ='$email';";    // da es sicher das email eindeutig 
                                $result =$fpConnection->query($update_status);
                                echo $update_status;
                                //echo " Aktulisierung erfolgreich";
                                header("location: ../index.php"); //witerleitung zur hompage
                             
                            }
                        }
                    
                        elseif( isset($_POST['resent_code'])){                      //code wiedersenden
                        require_once '../db/sent_verfication_code.php';
                        $_SESSION['mail_send']= "Der Bestätigungscode wurde nocheinmal versendet";
                        $sql ="UPDATE user SET verification_code='$code' WHERE email='$email'";     //aktulisiere code in db 
                        //echo $sql;
                        $result=$fpConnection->query($sql);
                    }
                    
                    if($email != $_SESSION['email'] && $verf_code ==  $_SESSION['verfication_code']){
                            $errors["email_errors"]="E-mail stimmt nicht";
                            //echo "E-mail stimmt nicht";
                    }
                  
                    if($email == $_SESSION['email'] && $verf_code != $_SESSION['verfication_code']){
                        $errors["code_errors"]="Bestätigungscode stimmt nicht";
                        //echo "Bestätigungscode stimmt nicht";
                    }
                    
                    if (($email != $_SESSION['email'] && $verf_code != $_SESSION['verfication_code'])){
                        $errors['verfication_error']='Die E-Mail und  Bestätigungscode stimmt nicht überein';
                        //echo ' Die E-Mail und  Bestätigungscode stimmt nicht überein';
                    }
                   
                    // db schliessen
                    mysqli_close($fpConnection);

                }
                catch (Exeption $e){
                    echo "Fehler bei der Verbindung ". $e;
                }
            }
       
        
        ?>
    <!--inhalt-->
    <div class="container">

        <div class="row">
            <center>
                <h4>Bitte Bestätigen Sie Ihre Riegistierung <br> Sie finden die Bestätigungscode in Ihrem E-Mail
                    Posteingang </h4>
            </center>
            <div class="im-centered">
                <a href="../index.php">
                    <img src="../Images/art.png" class="img-responsive">
                </a>
            </div>
        </div>
        <div class="row">
            <div id="loginbox" style="margin-top:40px;"
                class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">Registierung Bestätigen </div>
                    </div>
                    <div style="padding-top:30px; margin-top:0 px; background-color: #e3f2fd;" class="panel-body">

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                        <form action="verification.php" method="post" id="loginform" name="loginform"
                            class="form-horizontal" role="form">
                            <?php 
                    if(isset($_SESSION['mail_send'])){
                        ?>
                            <div class="alert alert-success text-center">
                                <?php echo $_SESSION['mail_send']; ?>
                            </div>
                            <?php
                    }
                    ?>
                            <?php
                    if(count($errors) > 0){
                        ?>
                            <div class="alert alert-danger text-center">
                                <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                            </div>
                            <?php
                    }
                 
                    ?>
                            <label for="username" class="label_dark">E-Mail: </label>
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="login-username" type="text" class="form-control" name="username"
                                    value="<?php echo $_SESSION['email']; ?>" placeholder=" E-Mail" readOnly="">
                            </div>
                            <label for="verification" class="label_dark">Bestätigungscode: </label>
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="verification_code" type="text" class="form-control" name="verification_code"
                                    placeholder="Bestätigungscode">
                            </div>
                            <div style="margin-top:10px" class="form-group">
                                <div class="col-sm-12 controls">
                                    <button type="submit" class="btn btn-primary" name="bestaetigen"  onclick="return daten_validieren();">Bestätigen
                                    </button>
                                </div>
                            </div>
                            
                            <div class="link login-link text-center label_dark">Sie haben noch Keine code erhalten
                            <button type="submit" class="btn btn-dark btn-sm" name="resent_code">code senden
                                    </button>
                            </div>
                        
                    </div>
                    </form>
                </div>

            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <hr>

        <!--footer-->
        <footer>
            <!-- Footer Links -->
            <?php include_once "fregment/footer.php" ?>
</body>

</html>