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
<div data-role="page" class="jqm-demos ui-responsive-panel" data-theme="<?php echo $theme; ?>" id="page1" data-title="Convertisseur">

<div data-role="header" data-theme="<?php echo $theme; ?>">
		<h1 style="color: #3388cc;font-weight: bold;font-size: 18px;">Bureau de change</h1>
		<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" rel="external" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-ajax="false">Back</a>
  	<a href="#" onclick="window.location.reload();" rel="external" data-shadow="false" data-iconshadow="false" data-icon="recycle" data-iconpos="notext" data-ajax="false">Back</a>
  	</div><!-- /header -->




<?php
$resultat = (isset($_GET['resultat']))?htmlspecialchars($_GET['resultat']):'';

if($resultat != '')
{
?>
<div class="alert alert-success" role="alert" style="margin-left: 4%;margin-right: 4%;margin-top: 2%;">
       <h5> <strong><?php echo $resultat; ?></strong></h5>
      </div>
<?php } ?>    

<form action="kartable_moteur.php?action=convertir_monnaie" method="post">

    <ul data-role="listview" data-inset="true">
<li class="ui-field-contain">
    <label for="devise_A" style="font-weight: bold;">Devise A : </label>
    <select name="devise_A" id="devise_A" data-role="slider">
    <option value="usd">$</option>
    <option value="fc" selected>FC</option>
</select>

    </li>
        <li class="ui-field-contain">
            <label for="montant" style="font-weight: bold;">Montant à convertir :</label>
            <input type="text" name="montant" id="montant" style="background-color: white;font-size: 18px;color: black;">
        </li>
<li class="ui-field-contain">
        <label for="devise_B" style="font-weight: bold;">Devise B : </label>
<select name="devise_B" id="devise_B" data-role="slider">
    <option value="usd">$</option>
    <option value="fc" selected>FC</option>
</select>

    </li>

        <li class="ui-field-contain">
            <label for="taux" style="font-weight: bold;">Taux de change : </label>
        <input type="text" name="taux" id="taux" style="background-color: white;font-size: 18px;color: black;" placeholder="Entrer le taux pour 1 $">
        </li>
        
        <li class="ui-body ui-body-<?php echo $theme; ?>">
            <fieldset class="ui-grid-a">
                    <div class="ui-block-b"><button type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-recycle" style="width: 200px;">Convertir</button></div>
            </fieldset>
        </li>
    </ul>
</form>