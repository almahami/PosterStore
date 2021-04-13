<?php  session_start(); 
      if($_SESSION['login'] !=111){
        header("Location: ../index.php");
    }

    if(isset($_POST['senden'])){

        $firstname=$_POST['firstname'];
        $lastname=$_POST['lastname'];
        $email= $_POST['email'];
        $thema=$_POST['thema'];
        $message=$_POST['textarea'];

        require '../PHPMailer/src/Exception.php';
        require '../PHPMailer/src/PHPMailer.php';
        require '../PHPMailer/src/SMTP.php';
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        
                                                                    //Server setting
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = "posterstore9@gmail.com" ;               //SMTP username
        $mail->Password   = 'ymckzieauyqhazub';                       //SMTP password
        $mail->CharSet ='UTF-8';

         //Recipients
        $mail->setFrom($email);
        $mail->addAddress('posterstore9@gmail.com');     //Add a recipient 
        $mail->addReplyTo($email, 'antwort an');
        $mail->addCC($email, $firstname , $lastname);

        //Content
        $mail->isHTML(true);                               //Set email format to HTML
        $mail->Subject = 'anfrage:'. $thema;                    // betreff
        $mail->Body=  '<p>' . $message . '</p>'. '<p>'.  $firstname . ' ' . $lastname. '</p>';
        
        if($mail->send()){
               header("Location: ../php/home.php");
            }
            
        }
    



?>
<!DOCTYPE html>
<html lang="de">

<head>
    <title> Help Page</title>
    <!--Meta Angaben-->
    <meta charset="UTF-8">

    <meta name="author" content="MOHAMMAD AL MAHAMID">
    <meta name="creator" content="MOHAMMAD AL MAHAMID">
    <meta name="creator" content="Basel Kahrof">

    <meta name="description" content="help">
 

    <!-- jquery -->
    <script src="../javaScript/jquery-2.1.4.min.js"></script>

    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- Font awesome http://fortawesome.github.io/Font-Awesome/-->
    <link href="../fontawesome/css/font-awesome.css" rel="stylesheet">
     
    <!--nav Stylesheet-->
     <link rel="stylesheet" href="../css/nav_styles.css">
    <!--sweetalert-->
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script>
         function mail_send(){
            swal('Danke schön', 'In kürze Zeit enthälten Sie Eine Antwort');
         }
     </script>
    
</head>

<body>
    
    <?php  include "setUp/navbar.php"; ?>
    <!--Ende Top navigation-->
    <div class="container">

        <div class="row">
            <center>
                <h4>Kontakt Formular</h4>
            </center>

        </div>
        <div class="row">
            <div id="loginbox" style="margin-top:50px;"
                class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">Kontakt Formular</div>
                    </div>

                    <div style="padding-top:30px; background-color: #e3f2fd;" class="panel-body">

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                        <form action="help.php" method="post"  id="helpForm" name="helpForm" class="form-horizontal"
                            role="form" onsubmit="mail_send();">
                            <lable  class="label_dark"> Firstname: </lable>
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"  required=""><i class="glyphicon glyphicon-user"></i></span>
                                <input id="firstname" type="text" class="form-control" name="firstname" value="<?php echo $_SESSION['firstname']; ?>"
                                    placeholder="Firstname">
                            </div>
                            <lable  class="label_dark">Lastname: </lable>
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="lastname" type="text" class="form-control" name="lastname" value="<?php echo $_SESSION['lastname'];?>"
                                    placeholder="Lastname">
                            </div>
                            <lable  class="label_dark">E-Mail:</lable>
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo $_SESSION['email']; ?>"  required=""
                                    placeholder="E-Mail">
                            </div>
                           
                            <div style="margin-bottom: 25px" class="input-group">
                                <div class="form-group">
                                    <label class="col-md-4 control-label label_dark for="thema">Thema:</label> <br>

                                    <div class="col-md-4">
                                    <div class="checkbox">
                                      <label for="thema-0" class="label_dark">
                                        <input type="checkbox" name="thema" id="thema-0"  value="Bestellung">
                                        Bestellung
                                      </label>
                                      </div>
                                    <div class="checkbox">
                                      <label for="thema-1" class="label_dark">
                                        <input type="checkbox" name="thema" id="thema-1" value="Feedback">
                                        Feedback
                                      </label>
                                      </div>
                                    <div class="checkbox">
                                      <label for="thema-2" class="label_dark">
                                        <input type="checkbox" name="thema" id="thema-2" value="Anders">
                                        Anders
                                      </label>
                                      </div>
                                    </div>
                                  </div>
                                  
                              
                               
                            </div>
                            <lable  class="label_dark">Nachricht: </lable>
                            <div style="margin-bottom: 25px" class="input-group">
                             
                                <textarea class="form-control" id="textarea" name="textarea" maxlength="1000" cols="70" rows="10"  required="" wrap="pysichal" required=""  placeholder="Schreiben Sie hier Ihre Nachricht an uns"> </textarea>
                            </div>
                            <div style="margin-top:10px" class="form-group">
                                <div class="col-sm-12 controls">
                                    <button type="submit" name="senden" id="senden"
                                        class="btn btn-primary">Senden</button>
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
        <hr>
         <!--footer-->
    <footer>
        <!-- Footer Links -->
        <div class="container text-center text-md-left mt-5">
            <div class="row mt-3">
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
    
                    <!-- Content -->
                    <h6 style=" padding: 10px; font-family: 'Poppins'; font-size: 14px;"
                        class="text-uppercase font-weight-bold">Mohammad AL Mahamid</h6>
                    <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p style="padding: 10px; font-family: 'Poppins'">&copy; 2021 Poster Stor | Made with<i
                            style="color: #fd4b4b;">&nbsp; &#9829; &nbsp;</i>in Tübingen</p>
    
                </div>
                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
    
                </div>
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase font-weight-bold">Useful links &#10004;</h6>
                    <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p>
                        <a href="#cart">Your Shopping Cart</a>
                    </p>
                    <p>
                        <a href="help.html">Help</a>
                    </p>
    
                </div>
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <h6 class="text-uppercase font-weight-bold">Contact &#9997;</h6>
                    <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p>
                        <i class="fa fa-home mr-3"></i> Germany, Tübingen 72762, Deutschland
                    </p>
                    <p>
                        <i class="fa fa-envelope mr-3"></i> posterStore@gmail.com
                    </p>
                    <p>
                        <i class="fa fa-phone mr-3"></i>01 57 31 99 84 27
                    </p>
                </div>
            </div>
        </div>
        </footer>


</body>

</html>