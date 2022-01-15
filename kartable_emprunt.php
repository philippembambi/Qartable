<?php
require('database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
<!--Css Jquey mobile-->
    <link rel="stylesheet" href="jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
    <link rel="stylesheet" href="listview-grid.css">
    <link rel="stylesheet" href="assets/css/jqm-demos.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome.css">
    <link rel="stylesheet" href="css/font-awesome.css">

<!--Css importées-->
    <link rel="stylesheet" href="portofolio/animate.css">
      <link href="portofolio/prettyPhoto.css" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="css/style.css"/>
      <link href="managerCss/bootstrap.min.css" rel="stylesheet">
     
      <!-- Material Design Bootstrap -->
      <link href="managerCss/mdb.min.css" rel="stylesheet">
      <!-- Your custom styles (optional) -->
      <link href="managerCss/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CodeJs/font-awesome.css">
    <link rel="stylesheet" href="./addStyle.css">
    <link rel="stylesheet" href="./css/theme_classic.css">

   <!--Vue.js--> 
  <script src="CodeJs/vue.js"> </script>
  <script src="managerJs/validation.js"></script>
  <script src="./kartable_ajax.js"></script>
  
<!--Js Jquery mobile-->
    <script src="jquery-2.1.1.min.js"></script>
    <script src="jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <script>
  
$.mobile.document.on( "pagebeforeshow", function(){
  make_sleep();

});
  </script>
</head>
<body>
<div data-role="page" class="jqm-demos ui-responsive-panel" data-theme="<?php echo $theme; ?>" id="page1" data-title="Emprunt">

<div data-role="header" data-theme="<?php echo $theme; ?>">
		<h1 style="color: #3388cc;font-weight: bold;font-size: 18px;">Enregistrement des Emprunts</h1>
		<a href="./" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-rel="back" data-ajax="false">Back</a>
	</div><!-- /header -->

<?php
$message = (isset($_GET['message']))?htmlspecialchars($_GET['message']):'';

if($message != '')
{
?>
<div class="alert alert-success" role="alert" style="margin-left: 4%;margin-right: 4%;margin-top: 2%;">
       <h5> <strong><?php echo $message; ?></strong></h5>
      </div>
<?php } ?>    

<form action="kartable_moteur.php?action=emprunter_argent" method="post" name="formulaire">
    <ul data-role="listview" data-inset="true">

    <li class="ui-field-contain">
<label for="" style="font-weight: bold; font-size: 17px;"><i class="fa fa-user"></i> Personnel : </label>
     <ul data-role="listview" data-filter="true" data-filter-reveal="true" data-filter-placeholder="Recherche ..." data-inset="true" data-theme="d">
<?php
 $query=$db->prepare('SELECT*  FROM kartable_personnel');
 $query->execute();

while ($data = $query->fetch())
{
?>
   <li style="margin-left: 28%;width: 99%;">
   <a href="<?php echo '#'.$data['id_personel']?>" class="ui-input-btn ui-btn ui-btn-c ui-icon-user ui-btn-icon-left ui-shadow-icon"><span style="color:black;"><?php echo $data['noms_personel']; ?>
   <label>
   <input type="checkbox" name="personnel" id="<?php echo $data['id_personel']?>" value="<?php echo $data['id_personel']?>">Selectionner
   </label>
   </span>
   </a>
   </li><p>
<?php 
}?>
</ul>
</li>

        <li class="ui-field-contain">
            <label for="montant" style="font-weight: bold;">Montant à emprunter :</label>
            <input type="number" name="montant" id="montant" style="background-color: white;font-size: 18px;color: black;" required="">
        </li>
<li class="ui-field-contain">
        <label for="devise" style="font-weight: bold;">Devise : </label>
  <select name="devise" id="devise" data-role="slider">
    <option value="usd">$</option>
    <option value="fc" selected>FC</option>
</select>
    </li>

        <li class="ui-field-contain">
            <label for="note" style="font-weight: bold;">Note : </label>
       <textarea name="note" id="note" cols="30" rows="10" style="background-color: white;color: black;" placeholder="Entrer une note descriptive de cette paie ..."></textarea>
        </li>
        
        <li class="ui-body ui-body-<?php echo $theme; ?>">
            <fieldset class="ui-grid-a">
                    <div class="ui-block-b">
                    <a href="#confirmation" data-rel="popup" data-position-to="window" id="valider" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-check" style="width: 200px;">Valider</a>        
                </div>
            </fieldset>
        </li>
    </ul>
</form>

<div data-role="popup" id="confirmation" data-overlay-theme="b" data-dismissible="false" style="max-width:400px;">

<div role="main" class="ui-content" style="background-color:white;">
    <h2 class="ui-title" style="color: black;font-size: 18px;">Confirmez-vous cette opération ?</h2>
<hr>
    <a href="#" class="ui-btn ui-corner-all ui-btn-inline ui-btn-c ui-btn-icon-left ui-icon-delete" data-rel="back" style="color: black;">Annuler</a>
    
    <a href="#" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b ui-btn-icon-left ui-icon-check" id="confirm">Confirmer</a>
</div>
</div>

<script>
var form =  document.formulaire;

document.getElementById('confirm').addEventListener('click',
function() {
    form.submit();
}, true);

</script>
<script type="text/javascript" src="portojs/bootstrap.min.js"></script>
<script type="text/javascript" src="portojs/jquery.isotope.min.js"></script>
<script type="text/javascript" src="portojs/wow.min.js"></script>
<script type="text/javascript" src="portojs/functions.js"></script>
<script type="text/javascript" src="managerJs/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="managerJs/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="managerJs/mdb.min.js"></script>
 <script src="SlideJs/custom.js"></script>
 <script type="text/javascript">
    // Animations initialization
    new WOW().init();
  </script>