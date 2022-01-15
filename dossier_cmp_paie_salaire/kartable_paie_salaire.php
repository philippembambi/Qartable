<?php
require('../database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <?php require('header_files.html'); ?>
<link href="../managerCss/bootstrap.min.css" rel="stylesheet">

<script>  
$.mobile.document.on( "pagebeforeshow", function(){
  make_sleep();

});
  </script>
</head>
<body>
<div data-role="page" class="jqm-demos ui-responsive-panel" data-theme="a" id="page1" data-title="Paie">

<div data-role="header" data-theme="c">
		<h1 style="color: #3388cc;font-weight: bold;font-size: 18px;">Paie des salariés</h1>
		<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" rel="external" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-ajax="false">Back</a>
        <a href="#" onclick="window.location.reload();" rel="external" data-shadow="false" data-iconshadow="false" data-icon="recycle" data-iconpos="notext" data-ajax="false" style="float: right;">Reload</a>
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

<form action="../kartable_moteur.php?action=payer_personnel" method="post" name="formulaire">
    <ul data-role="listview" data-inset="true">

    <li class="ui-field-contain">
<label for="" style="font-weight: bold; font-size: 17px;"><i class="fa fa-user"></i> Personnel : </label>
     <ul data-role="listview" data-filter="true" data-filter-reveal="true" data-filter-placeholder="Recherche ..." data-inset="true" data-theme="d">
<?php
 $query=$db->prepare('SELECT*  FROM kartable_personnel');
 $query->execute();

while ($data = $query->fetch())
{
    $mois = date('m',time());
    $q=$db->prepare('SELECT SUM(nbre_heure) AS total_heure FROM kartable_pointage 
    WHERE id_personnel = :id_personnel AND mois = :mois');
    $q->bindValue(':id_personnel', $data['id_personel'], PDO::PARAM_INT);
    $q->bindValue(':mois', $mois, PDO::PARAM_STR);
    $q->execute();
    $data2 = $q->fetch();
?>
   <li style="margin-left: 28%;width: 99%;">
   <a href="<?php echo '#'.$data['id_personel']?>" class="ui-input-btn ui-btn ui-btn-c ui-icon-user ui-btn-icon-left ui-shadow-icon"><span style="color:black;"><?php echo $data['noms_personel']; ?>
   <label>
   <input type="checkbox" name="personnel" id="<?php echo $data['id_personel']?>" value="<?php echo $data['id_personel']?>">Selectionner
   </label>
   </span>

   <div>
 *  Nombre d'heure totale : <b style="color: #3388cc;"> <?php echo $data2['total_heure'] . 'heure (s) </b>'; ?> <br>
 *  Salaire évalué : <b style="color: #3388cc;"> <?php echo (int) $data2['total_heure'] * 2500 .' FC </b>            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Pour 1 h = 2500 FC)'; ?>
 <br>
 * <?php
$this_month = date('m',time());
 echo $mois_actuel = ( (int) $this_month > 1)? ( (int) date('m',time()).' ième mois '.date('Y',time())): (int) date('m',time()).' ier mois '.date('Y',time()); ?>
</div>
   </a>
   </li><p>
<?php 
}?>
</ul>
</li>

<li class="ui-field-contain">
    <label for="type_rem" style="font-weight: bold;">Motif : </label>
    <select name="type_rem" id="type_rem" data-role="slider">
    <option value="prime">Prime</option>
    <option value="salaire" selected>Salaire</option>
    </select>
    </li>
        <li class="ui-field-contain">
            <label for="montant" style="font-weight: bold;">Montant (somme) :</label>
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
        
        <li class="ui-body ui-body-b">
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
<script type="text/javascript" src="../portojs/bootstrap.min.js"></script>
<script type="text/javascript" src="../portojs/jquery.isotope.min.js"></script>
<script type="text/javascript" src="../portojs/wow.min.js"></script>
<script type="text/javascript" src="../portojs/functions.js"></script>
<script type="text/javascript" src="../managerJs/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="../managerJs/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="../managerJs/mdb.min.js"></script>
 <script src="../SlideJs/custom.js"></script>
 <script type="text/javascript">
    // Animations initialization
    new WOW().init();
  </script>