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
    
    <?php  include "fregment/navbar.php"; ?>
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
         <?php  include 'fregment/footer.php' ?>


</body>

</html>