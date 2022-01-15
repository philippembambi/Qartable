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

   <!--Vue.js--> 
  <script src="CodeJs/vue.js"> </script>
  <script src="managerJs/validation.js"></script>
  <script src="./kartable_ajax.js"></script>
  
<!--Js Jquery mobile-->
    <script src="jquery-2.1.1.min.js"></script>
    <script src="jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <script src="./bbcode.js"></script>
    <script>
  
$.mobile.document.on( "pagebeforeshow", function(){
  make_sleep();

});
  </script>
</head>
<body>
<div data-role="page" class="jqm-demos ui-responsive-panel" data-theme="a" id="page1" data-title="Messagerie privée">

<div data-role="header" data-theme="c">
		<h1 style="color: #3388cc;font-weight: bold;font-size: 18px;">Messagerie privée</h1>
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

<form action="kartable_moteur.php?action=envoyer_msg" method="post" name="formulaire">
    <ul data-role="listview" data-inset="true">

    <li class="ui-field-contain">
<label for="" style="font-weight: bold; font-size: 17px;"><i class="fa fa-user"></i> Destinateur : </label>
     <ul data-role="listview" data-filter="true" data-filter-reveal="true" data-filter-placeholder="Recherche ..." data-inset="true" data-theme="d">
<?php
 $query=$db->prepare('SELECT*  FROM kartable_admin');
 $query->execute();

while ($data = $query->fetch())
{
?>
   <li style="margin-left: 28%;width: 99%;">
   <a href="<?php echo '#'.$data['id_admin']?>" class="ui-input-btn ui-btn ui-btn-c ui-icon-user ui-btn-icon-left ui-shadow-icon"><span style="color:black;"><?php echo $data['noms_admin']; ?>
   <label>
   <input type="checkbox" name="destinateur" id="<?php echo $data['id_admin']?>" value="<?php echo $data['id_admin']?>">Selectionner
   </label>
   </span>
   </a>
   </li><p>
<?php 
}?>
</ul>
</li>

        <li class="ui-field-contain">
            <label for="titre" style="font-weight: bold;">Titre du message :</label>
            <input type="text" name="titre" id="titre" style="background-color: white;font-size: 18px;color: black;" data-theme="d">
        </li>
<div style="margin-left: 23%;">
<button class="ui-btn ui-btn-d ui-btn-inline" onclick="bbcode('[g]', '[/g]');return(false)"><b> Gras</b></button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button class="ui-btn ui-btn-d ui-btn-inline" onclick="bbcode('[s]', '[/s]');return(false)"><u> Souligné </u></button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button class="ui-btn ui-btn-d ui-btn-inline" style="color: #3388cc;" onclick="bbcode('[couleur]', '[/couleur]');return(false)"> Coloré</button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button class="ui-btn ui-btn-d ui-btn-inline" onclick="bbcode('[url]', '[/url]');return(false)">Lien</button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button class="ui-btn ui-btn-d ui-btn-inline" onclick="bbcode('[i]', '[/i]');return(false)"><i> Italique</i></button>
</div>

<li class="ui-field-contain">
            <label for="msg" style="font-weight: bold;"><i class="fa fa-mail-forward"></i> Contenu du message : </label>
       
       <textarea name="msg" id="msg" cols="50" rows="20" style="background-color: white;color: black;border-color: black;" placeholder="Entrer une note descriptive de cette paie ..."></textarea>
        </li>
        
        <li class="ui-body ui-body-b">

            <fieldset class="ui-grid-a">
                    <div class="ui-block-b"><button type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-navigation" style="width: 200px;">Envoyer</button></div>
            </fieldset>
        </li>
    </ul>
</form>