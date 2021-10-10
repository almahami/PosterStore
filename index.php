<?php require_once 'db/login.php';?>

<!DOCTYPE html>
<html lang="de">

<head>
    <title>Login Page</title>
    <!--Meta Angaben-->
    <meta charset="UTF-8">

    <meta name="author" content="MOHAMMAD AL MAHAMID">
    <meta name="creator" content="MOHAMMAD AL MAHAMID">
    <meta name="creator" content="Basel Kahrof">

    <meta name="description" content="Login Page">

    <!-- jquery -->
    <script src="javaScript/jquery-2.1.4.min.js"></script>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- Font awesome http://fortawesome.github.io/Font-Awesome/-->
    <link href="fontawesome/css/font-awesome.css" rel="stylesheet">

    <!--nav Stylesheet-->
    <link rel="stylesheet" href="css/nav_styles.css">
      <!--A JavaScript implementation of the SHA family of hashes,-->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jsSHA/2.0.2/sha.js"></script>
    <style type="text/css">
        .im-centered {
            margin: auto;
            max-width: 600px;
        }
    </style>

    <!--Valideren Der Daten mit JavaScript-->
    <script>
        function daten_validieren() {
            var username = document.loginform.email;
            var password = document.loginform.password;
            //alert(username.value);

            if (username.value.length == 0) {
                alert("Bitte geben Sie ein Username ein! ")
                return false;
            }
            if (password.value.length == 0) {
                alert("Bitte geben Sie ein password ein! ")
                return false;
            }
            sha512Pwd();

        }
        function screen_size(){
            var width = screen.width; 
            var height = screen.height; 
            var list = document.getElementById("loginform");
            var createButton = document.createElement("input");
            
            createButton.type = "hidden";
            createButton.name="screen_size";
            createButton.value = width + "X" + height ;
            createButton.id = "screen_size";
            list.appendChild(createButton);
        }
    </script>
</head>

<body>
    <nav class="navbar navbar-light" style="background-color: #e3f2fd; margin-bottom: 0%;">
        <a class="navbar-brand" href="index.php" style="margin-left: 300px;"> Poster Store</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
           
        </div>
            
    </nav>

    <!--Content-->
    <div class="container">

        <div class="row">
            <center>
                <h4><a href='php/home.php'> zum Artikelübersicht </a></h4>
            </center>
            <div class="im-centered">
                <a href="php/home.php">
                    <img src="images/art.png" class="img-responsive">
                </a>
            </div>
        </div>
        <div class="row">
            <div id="loginbox" style="margin-top:50px;"
                class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">Login</div>
                    </div>

                    <div style="padding-top:30px; background-color: #e3f2fd;" class="panel-body">

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                        <form action="index.php" method="POST" id="loginform" name="loginform"
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
                                    <label for="password" class="label_dark">Passsword: </label>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="password" type="password" class="form-control" name="password"
                                            placeholder="password">
                                    </div>
                                    <div style="margin-top:10px" class="form-group">
                                        <div class="col-sm-12 controls">
                                            <button type="submit" class="btn btn-primary" name="login" onclick="screen_size();">login</button>
                                        </div>
                                    </div>
                                    <div class="link login-link text-center label_dark">Haben Sie noch Kein Konto?
                                        <a href="php/singUp_formular.php">Signup</a>
                                    </div>
                                    <div class="link login-link text-center label_dark">
                                        <a href="php/forgotPassword.php">passwort vergessen</a>
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
           <?php  include_once"php/fregment/footer.php"; ?>
            <script>
                function sha512Pwd(obj) {
                    var pwdObj = document.getElementById('password');
                    var hashObj = new jsSHA("SHA-512", "TEXT", {numRounds: 1});
                    hashObj.update(pwdObj.value);
                    var hash = hashObj.getHash("HEX");
                    pwdObj.value = hash;
                }
            </script>   
</body>

</html>