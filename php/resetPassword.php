<?php

    session_start();
    error_reporting();
    if($_SESSION['resetPassword'] !=1111){
        header("Location: forgotPassword.php");
    }
    //var_dump($_POST);

    $email= $_SESSION['email'];
    $vertificationPasswordRandom=$_SESSION['vertificationPasswordRandom'];
    $errors=array();
    $newPassword="";
    if(isset($_POST['senden'])){
        $newPassword=$_POST['newPassword'];
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

            $updatePassword="UPDATE `user` SET `password`='$newPassword' WHERE`email`='$email'; ";
            echo $updatePassword;
            $resultOfUpdatePassword=$fpConnection->query($updatePassword);
            if($resultOfUpdatePassword){
                header("Location: ../index.php");
            }
            
        //ende of try block    
        }catch(Exception $e){
            echo "Fehler bei db verbindung". $e;
        }

    //end of if block    
    }
    ?>


<!DOCTYPE html>
<html lang="de">

<head>
    <title> Kennenwort zurücksetzen</title>
    <!--Meta Angaben-->
    <meta charset="UTF-8">

    <meta name="author" content="MOHAMMAD AL MAHAMID">
    <meta name="creator" content="MOHAMMAD AL MAHAMID">
    <meta name="creator" content="Basel Kahrof">

    <meta name="description" content="password reset">

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
<!--Sweetalert-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!--Valideren Der Daten mit JavaScript-->
    <script>
        function daten_validieren() {

            var vertificationPasswordRandom ="<?php echo $vertificationPasswordRandom; ?>";  
            var vertificationPasswordForm = document.resetPassword.vertificationPassword;     
            var newPassword = document.resetPassword.newPassword;
            var coniformNewPassword =document.resetPassword.coniformNewPassword; 
           
            if( vertificationPasswordForm.value.length == 0 || newPassword.value.length == 0 || coniformNewPassword.value.length == 0){
                swal("Error", "Bitte Fühlen sie das Formular vollständig", "error");
                return false;
            }
           
            if (vertificationPasswordForm.value != vertificationPasswordRandom) {
                swal("Error","Das gegebene Passwort stimmt nicht mit der von uns geschicktes Passwort! ", "error");
                return false;
            }
            if(newPassword.value != coniformNewPassword.value){
                swal("Error", "Passworte stimmen nicht überein!", "error");
                return false;
            }
            sha512ConiformNewPwd(this);
            sha512NewPwd(this);
        }  
    </script>
      <style type="text/css">
        .im-centered {
            margin: auto;
            max-width: 600px;
        }
    </style>
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
                <h4></h4>
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
                        <div class="panel-title">kennwort zurücksetzen</div>
                    </div>

                    <div style="padding-top:30px; background-color: #e3f2fd;" class="panel-body">

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                        <form action="resetPassword.php" method="POST" id="resetPassword" name="resetPassword"
                            onsubmit="return daten_validieren();" class="form-horizontal" role="form">

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
                                        <input id="login-email" type="text" class="form-control" name="email" value="<?php  if(isset($_SESSION['email'])) {echo $email;}  ?> "
                                            placeholder="E-Mail" readonly>
                                    </div>
                                    <label for="password" class="label_dark"> erhaltenden Password: </label>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="password" type="password" class="form-control" name="vertificationPassword"
                                            placeholder="password" value="">
                                    </div>
                                    <label for="password" class="label_dark">Neues Passsword: </label>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="newPassword" type="password" class="form-control" name="newPassword"
                                            placeholder="neues password" value="">
                                    </div>
                                    <label for="password" class="label_dark">Neues Passsword bestätigen: </label>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="coniformNewPassword" type="password" class="form-control" name="coniformNewPassword"
                                            placeholder="bestätige das neue Passwort"  value="">
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
            <script>
                function sha512NewPwd(obj) {
                    var pwdObj = document.getElementById('newPassword');
                    var hashObj = new jsSHA("SHA-512", "TEXT", {numRounds: 1});
                    hashObj.update(pwdObj.value);
                    var hash = hashObj.getHash("HEX");
                    pwdObj.value = hash;
                }
                function sha512ConiformNewPwd(obj) {
                    var pwdObj = document.getElementById('coniformNewPassword');
                    var hashObj = new jsSHA("SHA-512", "TEXT", {numRounds: 1});
                    hashObj.update(pwdObj.value);
                    var hash = hashObj.getHash("HEX");
                    pwdObj.value = hash;
                }  
   
            </script>   
</body>

</html>