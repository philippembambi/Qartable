<?php
require('database.php');
$message = (isset($_GET['message']))?htmlspecialchars($_GET['message']):'';
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
<div data-role="page" class="jqm-demos ui-responsive-panel" data-theme="<?php echo $theme; ?>" id="page1" data-title="droit d'accès">

<div data-role="header" data-theme="<?php echo $theme; ?>">
		<h1 style="color: white;font-weight: bold;font-size: 18px;">Supprimer un droit d'accès</h1>
		<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" rel="external" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-ajax="false">Back</a>
		<a href="#" onclick="window.location.reload();" rel="external" data-shadow="false" data-iconshadow="false" data-icon="recycle" data-iconpos="notext" data-ajax="false">Back</a>
	</div><!-- /header -->

<?php
if($message != '')
{
?>
<div class="alert alert-success" role="alert">
       <h5> <strong><i class="fa fa-thumbs-o-up fa-2x"></i> <?php echo $message ?></strong></h5>
      </div>
<?php } ?>    
<br>

<form action="kartable_moteur.php?action=supprimer_droit_access" method="post" name="formulaire">

    <ul data-role="listview" data-inset="true">
        <li class="ui-field-contain">
            <label for="name2" style="font-weight: bold;"><i class="fa fa-user"></i>  Nom de l'administrateur:</label>
   
            <ul data-role="listview" data-filter="true" data-filter-reveal="true" data-filter-placeholder="Recherche ..." data-inset="true" data-theme="d">
<?php
 $q=$db->prepare('SELECT*  FROM kartable_admin');
 $q->execute();

while ($data_user = $q->fetch())
{
?>
   <li style="margin-left: 28%;width: 99%;">
   <a href="<?php echo '#'.$data_user['id_admin']?>" class="ui-input-btn ui-btn ui-btn-c ui-icon-user ui-btn-icon-left ui-shadow-icon"><span style="color:black;"><?php echo $data_user['noms_admin']; ?>
   <label>
   <input type="checkbox" name="admin" id="<?php echo $data_user['id_admin']?>" value="<?php echo $data_user['id_admin']?>">Selectionner
   </label>
   </span>
   </a>
   </li><p>
<?php } ?>
</ul>

        </li>
     
<li class="ui-field-contain">
<label for="" style="font-weight: bold; font-size: 17px;">Droit d'accès : </label>
     <ul data-role="listview" data-filter="true" data-filter-reveal="true" data-filter-placeholder="Recherche ..." data-inset="true" data-theme="d">
<?php
 $query=$db->prepare('SELECT*  FROM kartable_droit_acces');
 $query->execute();

while ($data = $query->fetch())
{
?>
   <li style="margin-left: 28%;width: 99%;">
   <a href="<?php echo '#'.$data['id_d_acces']?>" class="ui-input-btn ui-btn ui-btn-c ui-icon-lock ui-btn-icon-left ui-shadow-icon"><span style="color:black;"><?php echo $data['d_acces']; ?>
   <label>
   <input type="checkbox" name="droit_access" id="<?php echo $data['id_d_acces']?>" value="<?php echo $data['id_d_acces']?>">Selectionner
   </label>
   </span>
   </a>
   </li><p>
<?php } ?>
</ul>
</li>
        <li class="ui-body ui-body-b">
            <fieldset class="ui-grid-a">
            <a href="#confirmation" data-rel="popup" data-position-to="window" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-check" style="width: 200px;">Valider</a>
            </fieldset>
        </li>
    </ul>
</form>

<div data-role="popup" id="confirmation" data-overlay-theme="b" data-dismissible="false" style="max-width:400px;">

<div role="main" class="ui-content" style="background-color:white;">
    <h2 class="ui-title" style="color: black;font-size: 18px;">Voulez-vous vraiment supprimer ce droit d'accès ?</h2>
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