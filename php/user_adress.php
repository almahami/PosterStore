<?php 
  session_start();
  if($_SESSION['login'] !=111){
    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html>

<head>
    <title> Lieferadresse </title>
    <!--Meta Angaben-->
    <meta charset="UTF-8">

    <meta name="author" content="MOHAMMAD AL MAHAMID">
    <meta name="creator" content="MOHAMMAD AL MAHAMID">
    <meta name="creator" content="Basel Kahrof">

    <meta name="description" content="HOME Page">
 

    <!-- jquery -->
    <script src="../javaScript/jquery-2.1.4.min.js"></script>

    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- Font awesome http://fortawesome.github.io/Font-Awesome/-->
    <link href="../fontawesome/css/font-awesome.css" rel="stylesheet">
     
    <!--nav Stylesheet-->
     <link rel="stylesheet" href="../css/nav_styles.css">
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

      <script>
        function datavalidiern(){
          var radios = document.delivery_address.radios;
          var fisrtname = document.delivery_address.firstname;
          var lasttname = document.delivery_address.lastname;
          var plz = document.delivery_address.plz;
          var street = document.delivery_address.street;
          var city= document.delivery_address.city;
          var country= document.delivery_address.country;

          if (firstname.value.length == 0 && firstname.value.length == 0 && plz.value.length == 0 && street.value.length == 0 && city.value.length == 0 && country.value.length == 0 ) {
            swal("Error!", "Bitte Fühlen das Formular aus !", "error");
                return false;
            }
          if (firstname.value.length == 0) {
            swal("Error!", "Bitte geben Sie Ihren Vorname ein !", "error");
                return false;
            }
          if (lastname.value.length == 0) {
            swal("Error!", "Bitte geben Sie Ihren Nachname ein !", "error");
              return false;
          }
          if (plz.value.length == 0) {
            swal("Error!", "Bitte geben Sie  die Postleitzahl ein !", "error");
              return false;
          }
          if (street.value.length == 0) {
            swal("Error!", "Bitte geben Sie  die Strße ein !", "error");
                return false;
            }
          if (city.value.length == 0) {
            swal("Error!", "Bitte geben Sie  die Stadt ein !", "error");
              return false;
          }
          if (country.value.length == 0) {
            swal("Error!", "Bitte geben Sie  das Land ein !", "error");
                return false;
            }
          }

          function order_confirmation(){
            swal("Vielen Dank", "Bestellung Erfolgreich eingegangen", "success");
          }

         
          
      </script>
</head>

<body>
      <!--Ende Top navigation-->
      <?php   include "setUp/navbar.php" ?>
    <!--Ende Top navigation-->
    <br>
    <br>
    <!--Personliche Daten-->
    <section class="container">
    <form action="../db/user_adress_savedb.php" method="post" onsubmit="return datavalidiern();" name="delivery_address" class="form-horizontal" >
        <fieldset>
        
        <!-- Form Name -->
        <legend> <b>Lifereadresse</b></legend>
        
        <!-- Multiple Radios (inline) -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="radios">Anrede</label>
          <div class="col-md-4"> 
            <label class="radio-inline" for="radios-0">
              <input type="radio" name="radios" id="radios" value="Frau" checked="checked">
              Frau
            </label> 
            <label class="radio-inline" for="radios-1">
              <input type="radio" name="radios" id="radios" value="Herr">
              Herr
            </label>
          </div>
        </div>
        
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="firstname">Vorname</label>  
          <div class="col-md-4">
          <input id="firstname" name="firstname" type="text" placeholder="Vorname" value="<?php echo $_SESSION['firstname']; ?>" class="form-control input-md"  style="width: 50%;">
            
          </div>
        </div>
        
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="lastname">Nachname</label>  
          <div class="col-md-4">
          <input id="lastname" name="lastname" type="text" placeholder="Nachname" value="<?php echo $_SESSION['lastname']; ?>" class="form-control input-md"  style="width: 50%;">
            
          </div>
        </div>
        
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="plz">PLZ</label>  
          <div class="col-md-4">
          <input id="plz" name="plz" type="text" placeholder="PLZ"  value="<?php if(isset( $_SESSION['plz'])) echo $_SESSION['plz']; ?>" class="form-control input-md"  style="width: 30%;">
            
          </div>
        </div>
        
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="street">Straße Hausnr: </label>  
          <div class="col-md-4">
          <input id="street" name="street" type="text" placeholder="Straße"   value="<?php if(isset( $_SESSION['plz'])) echo $_SESSION['street']; ?>"  class="form-control input-md" style="width: 50%;">
            
          </div>
        </div>
        
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="city">Stadt</label>  
          <div class="col-md-4">
          <input id="city" name="city" type="text" placeholder="Stadt"   value="<?php if(isset( $_SESSION['plz'])) echo $_SESSION['city']; ?>" class="form-control input-md"  style="width: 50%;">
            
          </div>
        </div>
        
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="country">Land</label>  
          <div class="col-md-4">
          <input id="country" name="country" type="text" placeholder="Land"   value="<?php if(isset( $_SESSION['plz'])) echo $_SESSION['country']; ?>" class="form-control input-md" style="width: 50%;">
            
          </div>
        </div>
        
        <!-- Button (Double) -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="cancel"></label>
          <div class="col-md-8">
            <button id="cancel" name="cancel" class="btn btn-success">Abbrechen</button>
            <button  id="order" name="order" class="btn btn-success" onclick="order_confirmation()" >Bestellen</button> 
          </div>
        </div>
        </fieldset>
  </form>
</section>
    <br>
    <br>
    <br>
    <hr>
      <!--Footer --->
    <?php include_once"setUp/footer.php"  ?>

</body>
</html>
