<?php
require('database.php');
require('kartable_debut.php');
$id_promo = (isset($_GET['id_promo']))?$_GET['id_promo']:0;
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
<div data-role="page" class="jqm-demos ui-responsive-panel" data-theme="<?php echo $theme; ?>" id="page1" data-title="Comptabilités">

<div data-role="header" data-theme="<?php echo $theme; ?>">
		<h1 style="color: #3388cc;font-weight: bold;font-size: 18px;">Ajouter un cours dans l'horaire</h1>
		<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" rel="external" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-ajax="false">Back</a>
	  <a href="#" onclick="window.location.reload();" rel="external" data-shadow="false" data-iconshadow="false" data-icon="recycle" data-iconpos="notext" data-ajax="false">Back</a>
  
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

<br>

<form action="kartable_moteur.php?action=ajouter_cours&amp;id_promo=<?php echo $id_promo; ?>" method="post" name="formulaire">

<ul data-role="listview" data-inset="true">
        <li class="ui-field-contain">

        <label for="">Cours / Professeur :</label>
<ul data-role="listview" data-filter="true" data-filter-reveal="true" data-filter-placeholder="Recherche ..." data-inset="true" data-theme="d">
<?php
 $query=$db->prepare('SELECT*  FROM affectation_cours LEFT JOIN kartable_personnel 
 ON affectation_cours.id_enseignant = kartable_personnel.id_personel LEFT JOIN kartable_cours
 ON affectation_cours.id_cours = kartable_cours.id_cours');
  $query->execute();
while ($data = $query->fetch())
{
?>
   <li style="margin-left: 28%;width: 99%;">
   <a href="<?php echo '#'.$data['id_affectation']?>" class="ui-input-btn ui-btn ui-btn-c ui-icon-user ui-btn-icon-left ui-shadow-icon"><span style="color:black;"><?php echo $data['noms_personel']; ?>
   <label>
   <input type="checkbox" name="id_affectation" id="<?php echo $data['id_affectation']?>" value="<?php echo $data['id_affectation']?>">Selectionner
   </label>
  
   </span>
   <div style="font-size: 18px;">
   * Cours : <span style="color: #3388cc;"> <?php echo $data['intitule_cours']; ?></span> <br>
   </div>
   </a>
 
   </li><p></p>
<?php 
}?>
</ul>

</li>


<li class="ui-field-contain">

<label for="">Jour :</label>
<ul data-role="listview" data-filter="true" data-filter-reveal="true" data-filter-placeholder="Recherche ..." data-inset="true" data-theme="d">
<?php
$q=$db->prepare('SELECT*  FROM kartable_jours');
$q->execute();
while ($data2 = $q->fetch())
{
?>
   <li style="margin-left: 28%;width: 99%;">
   <a href="<?php echo '#'.$data2['id_jour']?>" class="ui-input-btn ui-btn ui-btn-c ui-icon-user ui-btn-icon-left ui-shadow-icon"><span style="color:black;"><?php echo $data2['nom_jour']; ?>
   <label>
   <input type="checkbox" name="id_jour" id="<?php echo $data2['id_jour']?>" value="<?php echo $data2['id_jour']?>">Selectionner
   </label>
   </span>
   </a> 
   </li>
<?php } ?>
</ul>

</li>

<li class="ui-field-contain">

<label for="">Heure :</label>
<ul data-role="listview" data-filter="true" data-filter-reveal="true" data-filter-placeholder="Recherche ..." data-inset="true" data-theme="d">
<?php
$q=$db->prepare('SELECT*  FROM heures');
$q->execute();
while ($data2 = $q->fetch())
{
?>
   <li style="margin-left: 28%;width: 99%;">
   <a href="<?php echo '#'.$data2['id_heure']?>" class="ui-input-btn ui-btn ui-btn-c ui-icon-user ui-btn-icon-left ui-shadow-icon"><span style="color:black;"><?php echo $data2['intitule_heure']; ?>
   <label>
   <input type="checkbox" name="id_heure" id="<?php echo $data2['id_heure']?>" value="<?php echo $data2['id_heure']?>">Selectionner
   </label>
   </span>
   </a> 
   </li>
<?php } ?>
</ul>

</li>

        <li class="ui-field-contain">
            <fieldset class="ui-grid-a">
                    <div class="ui-block-b">
                    <a href="#confirmation" data-rel="popup" data-position-to="window" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-check" style="width: 200px;">Valider</a></div>
            </fieldset>
        </li>

        </ul>
</form>

<div data-role="popup" id="confirmation" data-overlay-theme="b" data-dismissible="false" style="max-width:400px;">

<div role="main" class="ui-content" style="background-color:white;">
    <h2 class="ui-title" style="color: black;font-size: 18px;">Confirmez-vous cette action ?</h2>
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

    </body>

    </html>