<?php 
require('../database.php');
include('../kartable_debut.php');

$message = (isset($_GET["message"]))?htmlspecialchars($_GET["message"]):'';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <?php require('header_file.html');  ?>
  </head>
  <script>
$.mobile.document.on( "pagebeforeshow", function(){
  make_sleep();
});
</script>
<body>

<div data-role="page" class="jqm-demos ui-responsive-panel" data-title="paiement" data-url="paiement" data-theme="<?php echo $theme; ?>">

  <div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->
<p></p>
<?php
if($message != '')
{
?>
<div class="alert alert-success" role="alert">
       <h5> <strong><i class="fa fa-thumbs-o-up fa-2x"></i> Paiement de l'élève  <?php echo $message; ?> a été effectué avec succès !</strong></h5>
      </div>
<?php } ?>    


<form action="../kartable_moteur.php?action=payerFrais" method="post" data-ajax="false" rel="external" name="formulaire">

<label for="" style="font-weight: bold; font-size: 17px;"><i class="fa fa-user"></i> Rechercher un élève : </label>
     
     <ul data-role="listview" data-filter="true" data-filter-reveal="true" data-filter-placeholder="Recherche ..." data-inset="true" data-theme="d">


<?php
 $query=$db->prepare('SELECT*  FROM kartable_eleves LEFT JOIN kartable_promotion
 ON kartable_promotion.id_promotion = kartable_eleves.promotion_id');
 $query->execute();

while ($data = $query->fetch())
{
  $classe_promo = ($data['classe_promo'] > 1 )?($data['classe_promo']." ième"):($data['classe_promo']." ière année");
  $option_promo = $data['option_promo'];

?>
   <li>
   <a href="<?php echo '#'.$data['id_eleve']?>" class="ui-input-btn ui-btn ui-btn-c ui-icon-user ui-btn-icon-left ui-shadow-icon"><span style="color:black;"><?php echo $data['noms_eleve']; ?>
   <label>
   <input type="checkbox" name="eleve" id="<?php echo $data['id_eleve']?>" value="<?php echo $data['id_eleve']?>">Selectionner
   </label>
  
   </span>
   <div>
   * Classe : <span style="color: #3388cc;"> <?php echo $classe_promo. ' '.$option_promo; ?></span> <br>
   * Sexe : <span style="color: #3388cc;"> <?php echo $data['sexe_eleve']; ?></span>
   </div>
   </a>
 
   </li><p>
<?php 
}?>
</ul>


    <ul data-role="listview" data-inset="true">


        <li class="ui-field-contain">
            <label for="textarea2" style="font-weight: bold;">Montant à payer:</label>
        <input type="number" name="montant_frais" id="montant_frais" value="" style="background-color: white;font-size: 18px;color: black;" required="">
        </li>
<li class="ui-field-contain">
<label for="devise" style="font-weight: bold;">Devise:</label>
<select name="devise" id="devise" data-role="slider">
    <option value="$">$</option>
    <option value="fc" selected>FC</option>
</select>
</li>  

<li class="ui-field-contain">
<label for="Motif" style="font-weight: bold;">Motif de paiement:</label>

<fieldset id="Motif" data-role="collapsible" data-theme="<?php echo $theme; ?>">
    <legend>Choisir</legend>
    <div data-role="controlgroup" data-theme="c">
        <label for="fraisScolaire">Frais scolaire</label>
        <input type="checkbox" name="Motif" id="fraisScolaire" value="fraisScolaire">
        <label for="FraisExamen">Frais de participation aux examens</label>
        <input type="checkbox" name="Motif" id="FraisExamen" value="FraisExamen">
        <label for="TenuesScolaires">Achat tenues scolaires</label>
        <input type="checkbox" name="Motif" id="TenuesScolaires" value="TenuesScolaires">
        <label for="ExamenEtat">Frais d'examens d'Etat</label>
        <input type="checkbox" name="Motif" id="ExamenEtat" value="ExamenEtat">
        <label for="AutreMotif">Autre</label>
        <input type="checkbox" name="Motif" id="AutreMotif" value="AutreMotif">
    </div>
    <textarea name="descMotif" id="descMotif" cols="30" rows="10" data-theme="d" placeholder="Entrer une description ..."></textarea>
  </fieldset>
  </li>

  <li class="ui-field-contain">
<label for="Modalite" style="font-weight: bold;">Modalité de paiement:</label>

  <fieldset id="Modalite" data-role="collapsible" data-theme="<?php echo $theme; ?>">
    <legend>Modalité</legend>
    <div data-role="controlgroup" data-theme="c">
        <label for="Accompte">Accompte</label>
        <input type="checkbox" name="Modalite" id="Accompte" value="Accompte">
        <label for="tranche1">1 ière tranche</label>
        <input type="checkbox" name="Modalite" id="tranche1" value="tranche1">
        <label for="tranche2">2 ième tranche</label>
        <input type="checkbox" name="Modalite" id="tranche2" value="tranche2">
        <label for="Solde">Solde</label>
        <input type="checkbox" name="Modalite" id="Solde" value="Solde">
        <label for="AutreModalite">Autre</label>
        <input type="checkbox" name="Modalite" id="AutreModalite" value="Autre">
    </div>

    <textarea name="descModalite" id="descModalite" cols="30" rows="10" data-theme="d" placeholder="Entrer une description ..."></textarea>
  </fieldset>
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
 <script src="SlideJs/../custom.js"></script>
 <script type="text/javascript">
    // Animations initialization
    new WOW().init();
  </script>

    </body>

    </html>