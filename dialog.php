<?php
$erreur = (isset($_GET['erreur']))?true:false;
$msg = (isset($_GET['msg']))?htmlspecialchars($_GET['msg']):'';
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Authentification</title>
  <link rel="shortcut icon" type="image/png" href="./images/lock.png">
	<!--Css Jquey mobile-->
    <link rel="stylesheet" href="./jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
    <link rel="stylesheet" href="./assets/css/jqm-demos.css">
    <link rel="stylesheet" href="./font-awesome.css">
    <link rel="stylesheet" href="./css/font-awesome.css">
<!--Css importées-->
    <link rel="stylesheet" href="./portofolio/animate.css">
      <link href="./portofolio/prettyPhoto.css" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="./css/style.css"/>
      <link href="./managerCss/bootstrap.min.css" rel="stylesheet">
      <!-- Material Design Bootstrap -->
      <link href="./managerCss/mdb.css" rel="stylesheet">
      <!-- Your custom styles (optional) -->
      <link href="managerCss/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/theme_classic.css">

<!--Js Jquery mobile-->
    <script src="./jquery-2.1.1.min.js"></script>
    <script src="./jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <script src="./managerJs/myscripts.js"></script>
    <script src="./kartable_ajax.js"></script>
    
</head>
<body onload="document.getElementById('loginadmin').click();">
   <!--authentification admin-->
   <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" >
    <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
      <!--Content-->
      <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
          <img src="images/user.png" class="rounded-circle img-responsive"
            alt="Avatar photo">
        </div>
        <!--Body-->
        <div class="modal-body text-center mb-1">
 <h5 class="mt-1 mb-2">Administrateur</h5>
 <?php
 if($msg != "")
 {  
 ?>
 <hr>
 <h6 style="color: red;"><strong><i class="fa fa-warning"></i></strong>&nbsp;&nbsp; <?php echo $msg; ?></h6>

 <?php } 
elseif($erreur != '')
{ ?>
<hr>
 <h6 style="color: red;"><strong><i class="fa fa-warning"></i></strong>&nbsp;&nbsp; Mot de passe incorrect</h6>
<?php }

else{ 
  ?>
<hr>
 <h6 style="color: red;"><strong><i class="fa fa-warning"></i></strong>&nbsp;&nbsp; Identifiez-vous</h6>
<?php } ?>

     <div class="md-form ml-0 mr-0">
            <label for="form1" class="ml-0">Mot de Passe...</label>
            <input type="password" type="text" id="motdepasse" name="motdepasse" class="form-control ml-0" required="">            
          <span id="reponseAdmin"></span>
          </div>

          <div class="text-center mt-4">
            <button class="ui-btn ui-corner-all ui-icon-check ui-btn-icon-left ui-shadow ui-btn-inline ui-btn-b" onclick="connect_admin()"> Valider
            </button>
      </div>        </div>  </div>   <!--/.Content--> </div> </div>


<div data-role="page" data-theme="c">
  <div data-role="header" style="overflow:hidden;" data-theme="c">
  </div>

  <div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->


  <div class="ui-corner-all custom-corners" style="
  position: relative;  margin: 0 auto;  
  width: 600px;margin-top: 10%;box-shadow: 1px 4px #3388cc;" data-theme="c">

<?php
if($erreur != '')
{
?>
<div class="alert alert-danger" role="alert">
       <h5> <strong><i class="fa fa-alert fa-2x"></i> Mot de passe erroné</strong></h5>
      </div>
<?php } 
 elseif($msg != "")
 {  
 ?>
 <div class="alert alert-danger" role="alert">
       <h5> <strong><i class="fa fa-alert fa-2x"></i> <?php echo $msg; ?></strong></h5>
      </div>
<?php } ?>

    <div class="ui-bar ui-bar-a">
  <i class="fa fa-lock fa-2x"></i>  &nbsp;
      <h3 style="color: white;font-size: 20px;"><b>Authentification Admin</b></h3>
    </div>
    <div class="ui-body ui-body-a">
      <p style="text-align: center;">
        
Veillez vous identifier étant que <strong>Administrateur</strong> pour avoir accès au logiciel <br>
Cliquez sur le bouton ci_dessous pour ouvrir le formulaire d'authentification 
</p>
<hr>
<button id="loginadmin" data-toggle="modal" data-target="#modalLogin" class="ui-btn ui-corner-all ui-icon-user ui-btn-icon-left ui-shadow ui-btn-inline ui-btn-b">Login admin</button>

</div>
<div class="content" style="text-align: center;">
<p>
  <br>
En validant votre authentification, vous accepter les conditions d'utilisation
  <label for="grid-checkbox-1">Accepter les cookies</label>
  <input type="checkbox" id="grid-checkbox-1" name="grid-checkbox-1">
</p>
</div>
  </div>
               
</div>

</div>


	<script type="text/javascript" src="portojs/bootstrap.min.js"></script>
<script type="text/javascript" src="portojs/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="portojs/jquery.isotope.min.js"></script>
<script type="text/javascript" src="portojs/wow.min.js"></script>
<script type="text/javascript" src="portojs/functions.js"></script>
<script type="text/javascript" src="managerJs/jquery-2.1.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="managerJs/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="managerJs/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="managerJs/mdb.min.js"></script>
 <script src="SlideJs/custom.js"></script>

 <script type="text/javascript">
    // Animations initialization
    new WOW().init();

  </script>

</body>
</html>
