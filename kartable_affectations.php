<?php 
require('database.php');
$message = (isset($_GET["message"]))?htmlspecialchars($_GET["message"]):'';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
<!--Css Jquey mobile-->
    <link rel="stylesheet" href="./jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
    <link rel="stylesheet" href="./assets/css/jqm-demos.css">
<!--Css importées-->
    <link rel="stylesheet" href="./portofolio/animate.css">
      <link href="./portofolio/prettyPhoto.css" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="./css/style.css"/>
      <link href="./managerCss/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="./css/font-awesome.css">

     
      <!-- Material Design Bootstrap -->
      <link href="./managerCss/mdb.css" rel="stylesheet">
      <!-- Your custom styles (optional) -->
      <link href="./managerCss/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/addStyle.css">
    <link rel="stylesheet" href="./css/theme_classic.css">
   <!--Vue.js--> 
  <script src="./vue.js"> </script>
  <script src="./managerJs/myscripts.js"></script>
  <script src="./kartable_ajax.js"></script>
  
<!--Js Jquery mobile-->
    <script src="./jquery-2.1.1.min.js"></script>
    <script src="./jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>
  
  </head>
  <script>
$.mobile.document.on( "pagebeforeshow", function(){
  make_sleep();
});
  </script>
<body>

<div data-role="page" class="jqm-demos ui-responsive-panel" id="affectation" data-title="affectation" data-url="affectation" data-theme="a">

<div data-role="header" data-theme="a">

<div data-role="header" data-theme="c">
		<h1 style="color: #3388cc;font-weight: bold;font-size: 18px;">Affectation des cours</h1>
		<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" rel="external" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-ajax="false">Back</a>
	</div><!-- /header -->

  <div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->

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

<form action="kartable_moteur.php?action=affectationCours" method="post" name="formulaire" rel="external">

<label for="">Rechercher un enseignant :</label>
      <ul data-role="listview" data-filter="true" data-filter-reveal="true" data-filter-placeholder="Recherche ..." data-inset="true" data-theme="d">

<?php
  $query=$db->prepare('SELECT*  FROM kartable_personnel WHERE fonction = "enseignant" ');
  $query->execute();
while ($data = $query->fetch())
{
?>
    <li>
    <a href="<?php echo '#'.$data['id_personel']?>" class="ui-input-btn ui-btn ui-btn-c ui-icon-user ui-btn-icon-left ui-shadow-icon"><?php echo $data['noms_personel']; ?>
    <label>
    <input type="checkbox" name="enseignant" id="<?php echo $data['id_personel']?>" value="<?php echo $data['id_personel']?>">Selectionner
    </label>
    </span>
    </a>  
    </li><p></p>
<?php 
}?>
</ul>

<label for="">Affecté au cours de :</label>
<ul data-role="listview" data-filter="true" data-filter-reveal="true" data-filter-placeholder="Recherche ..." data-inset="true" data-theme="d">
<hr>
<?php
$q=$db->prepare('SELECT*  FROM kartable_cours');
$q->execute();

while ($data2 = $q->fetch())
{
?>
<li class="ui-field-contain">
<a href="<?php echo '#'.$data2['id_cours']?>" class="ui-input-btn ui-btn ui-btn-c ui-icon-grid ui-btn-icon-left ui-shadow-icon"><span style="color:white;"><?php echo $data2['intitule_cours']; ?>
<label>
<input type="checkbox" name="cours" id="<?php echo $data2['id_cours']?>" value="<?php echo $data2['id_cours']?>">Selectionner
</label>

</span>
</a>

</li><p>
<?php 
}?>
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