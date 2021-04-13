<?php require_once'../db/singUp_db.php';?>
<!DOCTYPE html>
<html lang="de">

<head>
    <title>singUp Page</title>
    <!--Meta Angaben-->
    <meta charset="UTF-8">

    <meta name="author" content="MOHAMMAD AL MAHAMID">
    <meta name="creator" content="MOHAMMAD AL MAHAMID">
    <meta name="creator" content="Basel Kahrof">

    <meta name="description" content="singUp Page">

    <!-- jquery -->
    <script src="../javaScript/jquery-2.1.4.min.js"></script>

    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    <!--Singin Stylesheet-->
    <link rel="stylesheet" href="../css/Sing_in_up_styles.css">
    <!-- Font awesome http://fortawesome.github.io/Font-Awesome/-->
    <link href="../fontawesome/css/font-awesome.css" rel="stylesheet">
 
    <!--nav Stylesheet-->
    <link rel="stylesheet" href="../css/nav_styles.css">

    <!--A JavaScript implementation of the SHA family of hashes,-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsSHA/2.0.2/sha.js"></script>
    <!--Daten des Formular validieren bevore die Daten an Server gwschickt-->
    <script>
        function daten_validieren() {
            var firstname = document.singUPform.firstname;
            var lastname = document.singUPform.lastname;
            var email = document.singUPform.email;
            var password = document.singUPform.password;
            var ConfirmPassword = document.singUPform.ConfirmPassword;

            //wenn aller Felder leer
            if (firstname.value.length == 0 && lastname.value.length == 0 && email.value.length == 0 && password.value.length == 0 && ConfirmPassword.value.length == 0) {
                alert("Bitte Fühlen Sie das Formular aus");
                return false;
            }
            //firname Feld leer
            if (firstname.value.length == 0 && lastname.value.length != 0 && email.value.length != 0 && password.value.length != 0 && ConfirmPassword.value.length != 0) {
                alert("Bitte geben Sie Ihre Vorname ein");
                return false;
            }
            // Feld Lastname leer
            if (firstname.value.length != 0 && lastname.value.length == 0 && email.value.length != 0 && password.value.length != 0 && ConfirmPassword.value.length != 0) {
                alert("Bitte geben Sie Ihre nachname ein");
                return false;
            }
            //Feld email leer
            if (firstname.value.length != 0 && lastname.value.length != 0 && email.value.length == 0 && password.value.length != 0 && ConfirmPassword.value.length != 0) {
                alert("Bitte geben Sie Ihre email ein");
                return false;
            }
            //pasword ist leer
            if (firstname.value.length != 0 && lastname.value.length != 0 && email.value.length != 0 && password.value.length == 0 && ConfirmPassword.value.length != 0) {
                alert("Bitte geben Sie Ihre password ein");
                return false;
            }
            //confirm password is leer
            if (firstname.value.length != 0 && lastname.value.length != 0 && email.value.length != 0 && password.value.length != 0 && ConfirmPassword.value.length == 0) {
                alert("Bitte besätigen Sie Ihr Password")
            }
            // alle Felder sind ausgefühlt aber passwörter stimmen nicht überein
            if (firstname.value.length != 0 && lastname.value.length != 0 && email.value.length != 0 && password.value != ConfirmPassword.value) {
                alert("passwörter stimmen nicht überein");
                return false;
            }
        }
    </script>

</head>

<body>

    <!--Top -->
    <nav class="navbar navbar-light" style="background-color: #e3f2fd; margin-bottom: 0%;">
        <a class="navbar-brand" href="../index.php"> Poster Store</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-3">
                <li class="nav-item" style="margin-left: 300px;">

                </li>
            </ul>
        </div>
    </nav>
    <!--Ende Top-->
    <div class="container">

        <div class="row">
            <center>
                <h4>Wilkomen auf unsere Homepage</h4>
            </center>

        </div>
        <div class="row">
            <div id="loginbox" style="margin-top:50px;"
                class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">singUp</div>
                    </div>

                    <div style="padding-top:30px; background-color: #e3f2fd;" class="panel-body">

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                        <form action="singUp_formular.php" method="post" onsubmit="return daten_validieren();"
                            id="singUPform" name="singUPform" class="form-horizontal" role="form">
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
                                    <lable class="label_dark"> Firstname: </lable>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="firstname" type="text" class="form-control" name="firstname" value=""
                                            placeholder="Firstname">
                                    </div>
                                    <lable class="label_dark">Lastname: </lable>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="lastname" type="text" class="form-control" name="lastname" value=""
                                            placeholder="Lastname">
                                    </div>
                                    <lable class="label_dark">E-Mail:</lable>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i
                                                class="glyphicon glyphicon-envelope"></i></span>
                                        <input id="email" type="email" class="form-control" name="email" value=""
                                            placeholder="E-Mail">
                                    </div>
                                    <lable class="label_dark">Password: </lable>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="password" type="password" class="form-control" name="password"
                                            placeholder="password">
                                    </div>
                                    <lable class="label_dark">Confirm Password: </lable>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="ConfirmPassword" type="password" class="form-control"
                                            name="ConfirmPassword" minlength="4" placeholder="Confirm password">
                                           
                                    </div>
                                    <div style="margin-top:10px" class="form-group">
                                        <div class="col-sm-12 controls">
                                            <button type="submit" onclick="sha512Pwd(); sha512CPwd();" class="btn btn-primary" name="singUp">singUp</button>
                                        </div>
                                    </div>

                                </div>
                        </form>
                        <div class="link login-link text-center label_dark">You have Already account?
                            <a href="../index.php">Sing in </a>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
            <hr>
            <!--footer-->
            <?php include_once "setUp/footer.php" ?>

            <script>
                  function sha512Pwd(obj) {
                    var pwdObj = document.getElementById('password');
                    var hashObj = new jsSHA("SHA-512", "TEXT", {numRounds: 1});
                    hashObj.update(pwdObj.value);
                    var hash = hashObj.getHash("HEX");
                    pwdObj.value = hash;
                }
                function sha512CPwd(obj) {
                    var pwdObj = document.getElementById('ConfirmPassword');
                    var hashObj = new jsSHA("SHA-512", "TEXT", {numRounds: 1});
                    hashObj.update(pwdObj.value);
                    var hash = hashObj.getHash("HEX");
                    pwdObj.value = hash;
                    return hash;
                }

            </script>
</body>

</html>