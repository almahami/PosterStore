<?php

    session_start();
    error_reporting();
    //var_dump($_POST);

    $errors=array();
    $email="";
    if(isset($_POST['email'])){
        $email=$_POST['email'];
    }
    
    if(isset($_POST['senden'])){

        try{
            $fpConnection = mysqli_connect('localhost', 'root', '', 'poster_store');
            if(! $fpConnection){    	                                                    // Error  
                echo "Fehler: Verbindung kann nich gestellt werden"- PHP_EQL;
                echo "Debug Fehlernummer " . mysqli_connect_errno(). PHP_EQL;
                echo "Debugb Fehlernummer ". mysqli_connect.eroor(). PHP_EQL;
                exit;
            }

            $isEmailexist="SELECT * FROM user WHERE email='$email';";
            //echo $isEmailexist;
            $resultOfIsEmailExist= $fpConnection->query($isEmailexist);
            if($resultOfIsEmailExist->num_rows > 0){

                $vertificationPasswordRandom =rand(99999,11111);
                //echo $vertificationPassword;  
                require '../PHPMailer/src/Exception.php';
                require '../PHPMailer/src/PHPMailer.php';
                require '../PHPMailer/src/SMTP.php';
                $mail = new PHPMailer\PHPMailer\PHPMailer();

                try {
                                                                                //Server settings

                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = "posterstore9@gmail.com" ;               //SMTP username
                    $mail->Password   = 'ymckzieauyqhazub';                       //SMTP password
                    $mail->CharSet ='UTF-8';

                    //Recipients
                    $mail->setFrom('posterstore9@gmail.com', 'POSTER STORE');
                    $mail->addAddress($email);     //Add a recipient

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Passwort zurücksetzen';                    // betreff
                    $mail->Body    = 'Hiermit senden wir Ihnen einen password, mit dem Sie sich identifiziern und  Ihrem Password zurücksetzen können <b>' . $vertificationPasswordRandom .' !</b>';


                    if($mail->send()){
                        $_SESSION['email']=$email;
                        $_SESSION['vertificationPasswordRandom']=$vertificationPasswordRandom;               // code in session speichern 
                        $_SESSION['mail_send']= "wir haben Ihnen eine password per E-Mail gesendet";// resultat in session speichern
                        $_SESSION['resetPassword']=1111;
                        header("Location: resetPassword.php");
                    }
                    else{
                        $_SESSION["email_error"]= "es gibt ein Fehler " . $mail->ErrorInfo;
                    }
                    mysqli_close($fpConnection); 
                //end of try block
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }

            }
            else if($resultOfIsEmailExist->num_rows ==0){
                $errors['emailDoseNotExist']="Die angegebne E-Mail Adresse von Ihnen ist ungültig";
            }
        }catch(Exception $e){
            echo "Fehler bei db verbindung ". $e;
        }


        //end of if
    }

?>
<!DOCTYPE html>
<html lang="de">

<head>
    <title>Passwort vergessen</title>
    <!--Meta Angaben-->
    <meta charset="UTF-8">

    <meta name="author" content="MOHAMMAD AL MAHAMID">
    <meta name="creator" content="MOHAMMAD AL MAHAMID">
    <meta name="creator" content="Basel Kahrof">

    <meta name="description" content="Forget Password">

    <!-- jquery -->
    <script src="../javaScript/jquery-2.1.4.min.js"></script>

    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    <!-- Font awesome http://fortawesome.github.io/Font-Awesome/-->
    <link href="../fontawesome/css/font-awesome.css" rel="stylesheet">

    <!--nav Stylesheet-->
    <link rel="stylesheet" href="../css/nav_styles.css">
    <!--A JavaScript implementation of the SHA family of hashes,-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsSHA/2.0.2/sha.js"></script>
    <!---Sweetalert-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <style type="text/css">
        .im-centered {
            margin: auto;
            max-width: 600px;
        }
    </style>

    <!--Valideren Der Daten mit JavaScript-->
    <script>
        function daten_validieren() {
            var username = document.forgotPassword.email;

            if (username.value.length == 0) {
                swal("Error", "Bitte geben Sie ein Username ein! ", "error");
                return false;
            }
            else{
                return true;
            }

        }
    </script>
</head>

<body>
    <nav class="navbar navbar-light" style="background-color: #e3f2fd; margin-bottom: 0%;">
        <center>
            <a class="navbar-brand" href="../index.php" style="margin-left: 300px;"> Poster Store</a>
        </center>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-6">
                <li class="nav-item" style=" margin-left: 500px;">
                    <h2 style="text-align: center;"></h2>
                </li>
            </ul>
        </div>
            
    </nav>

    <!--Content-->
    <div class="container">

        <div class="row">
            <center>
                <h4><b>Problem beim Anmelden</b></h4>
                <pre>Geben Sie Bitte Ihre E-Mail-Adresse, damit wir Ihnen einen password senden können,
                 mit dem Sie sich identifiziern und  das Password zurück in ihrem Konto gelangen.</pre>
            </center>
            <div class="im-centered">
                <a href="index.php">
                    <img src="../images/art.png" class="img-responsive">
                </a>
            </div>
        </div>
        <div class="row">
            <div id="loginbox" style="margin-top:50px;"
                class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">password vergessen</div>
                    </div>

                    <div style="padding-top:30px; background-color: #e3f2fd;" class="panel-body">

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                        <form action="forgotPassword.php" method="POST" id="loginform" name="forgotPassword"
                            onsubmit="return daten_validieren();" class="form-horizontal" role="form">

                            <?php
                    if(count($errors) == 1){
                        ?>
                            <div class="alert alert-danger text-center" style="padding=156px;">
                                <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                            </div>
                            <?php
                    }elseif(count($errors) > 1){
                        ?>
                            <div class="alert alert-danger text-center" style="padding=156px;">
                                <?php
                            foreach($errors as $showerror){
                                ?>
                                <li>
                                    <?php echo $showerror; ?>
                                </li>
                                <?php
                            }
                            ?>
                                <div>
                                    <?php
                    }
                    ?>
                                    <label for="username" class="label_dark">E-Mail: </label>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-email" type="text" class="form-control" name="email" value=""
                                            placeholder="E-Mail">
                                    </div>
                                    <div style="margin-top:10px" class="form-group">
                                        <div class="col-sm-12 controls">
                                            <button type="submit" class="btn btn-primary" name="senden">senden</button>
                                        </div>
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
           <?php  include_once"fregment/footer.php"; ?>
</body>

</html>