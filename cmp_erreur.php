<?php
$type_erreur = (isset($_GET['type']))?htmlspecialchars($_GET['type']):'';
$message_erreur = (isset($_GET['msg']))?htmlspecialchars($_GET['msg']):'';
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Page d'erreur</title>
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
<body>
   

<div data-role="page" data-theme="d">
  <div data-role="header" style="overflow:hidden;" data-theme="c">
  </div>

  <div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->


  <div class="ui-corner-all custom-corners" style="
  position: relative;  margin: 0 auto;  
  width: 600px;margin-top: 1%;box-shadow: 1px 4px #3388cc;" data-theme="c">

<?php 
 if($type_erreur != "" && $message_erreur != "")
 {  
 ?>
 <div class="alert alert-danger" role="alert" style="font-weight: bold;">
      <a href="#"> <h5 style="color: red;"><i class="fa fa-warning"></i> <?php echo $type_erreur; ?></h5></a>
       
       <h5 style="font-size: 18px; font-family: leelawadee;"><?php echo $message_erreur; ?></h5>
      </div>
<?php } ?>

    <div class="ui-bar ui-bar-a">
  <i class="fa fa-lock fa-2x"></i>  &nbsp;
      <h3 style="color: white;font-size: 20px;"><b>Droit d'accès Admin</b></h3>
    </div>
    <div class="ui-body ui-body-a">
      <p style="text-align: center;">
Pour assurer la fiabilité du système, Kartable procède par les droits d'accès afin d'identifier les champs d'actions, autorisations et limites de chaque <strong>Administrateur</strong>. Ainsi la sécurité, la confidentialité et la restriction sont garanties dans le système.  
</p>
<hr>
<a href="./dialog.php" rel="external" target="_blank" class="ui-btn ui-corner-all ui-icon-user ui-btn-icon-left ui-shadow ui-btn-inline ui-btn-b">Login admin</a>

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
