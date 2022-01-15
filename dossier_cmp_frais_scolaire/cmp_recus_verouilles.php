<?php
require('../database.php');
include('../kartable_debut.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <?php require('header_file.html');  ?>

    <script>
$.mobile.document.on( "pagebeforeshow", function(){
  make_sleep();

});
  </script>
</head>
<body>
<div data-role="page" class="jqm-demos ui-responsive-panel" data-theme="a" id="page1" data-title="Index Kartable">

<div data-role="header" data-theme="a">
<h1 style="color: white;">Reçu des Frais scolaires vérouillés</h1>
<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" rel="external" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-ajax="false">Back</a>
  	<a href="#" onclick="window.location.reload();" rel="external" data-shadow="false" data-iconshadow="false" data-icon="recycle" data-iconpos="notext" data-ajax="false">Back</a>
  </div><!-- /header -->
	

  <div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->
<br>

<?php
$req=$db->prepare('SELECT*  FROM kartable_frais_scolaire LEFT JOIN kartable_eleves
ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve WHERE erreur_signalee = "oui"
ORDER BY date_paiement DESC');
$req->execute();

echo '<table 
data-role="table" 
id="table-custom-1"  
class="ui-body-a ui-shadow table-stripe ui-responsive" 
>' . "\n"; 

echo '<thead style="color: #3388cc;">
<tr>';

echo "<th data-priority='1'>id paiement</th>
      <th>Noms de l'élève</th>
      <th>Montant payé</th>
      <th>Motif</th>
      <th>Modalité</th>
      <th>Date</th>
      <th>Dette</th>
      <th>Suppression</th>
      <th>Déverouillage</th>";
echo '</tr></thead><tbody>';

$solde=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "Solde"');
$solde->execute();
$dataSolde = $solde->fetch();

while ($data1 = $req->fetch())
{
  $dette = $dataSolde['montant_modalite'] - $data1['montant'];

    echo '<tr>' . "\n";  
    echo '<td style="font-weight: bold;">' . $data1['id_frais'] . '</td>' . "\n"; 
    echo '<td style="font-weight: bold;">' . $data1['noms_eleve'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['montant'] .' '.$data1['devise']. '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['motif'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['modalite'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['date_paiement'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">'. $dette.' $</td>' . "\n";

    echo '<td style="font-weight: bold;"> <a href="#sup'.$data1['id_frais'].'" data-rel="popup" data-position-to="window" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-lock" style="width: 80px;">Supprimer</a>
    </td>' . "\n";

    echo '<td style="font-weight: bold;"> <a href="#'.$data1['id_frais'].'" data-rel="popup" data-position-to="window" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-lock" style="width: 80px;">Déverouiller</a>
    </td>' . "\n";
    echo '</tr>' . "\n";
} 
echo '</tbody>';
echo '</table>' . "\n";
?>
</div>

<?php 
$requete=$db->prepare('SELECT*  FROM kartable_frais_scolaire LEFT JOIN kartable_eleves
ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve WHERE erreur_signalee = "oui"
ORDER BY date_paiement DESC');
$requete->execute();

while ($data2 = $requete->fetch())
{
    ?>

<div data-role="popup" id="<?php echo $data2['id_frais']; ?>" data-overlay-theme="b" data-dismissible="false" style="max-width:400px;">

<div role="main" class="ui-content" style="background-color:white;">
    <h2 class="ui-title" style="color: black;font-size: 18px;">Voulez-vous déverouiller ce reçu ?</h2>
<hr>
    <a href="#" class="ui-btn ui-corner-all ui-btn-inline ui-btn-c ui-btn-icon-left ui-icon-delete" data-rel="back" style="color: black;">Annuler</a>
    
    <a href="../kartable_moteur.php?action=deverouiller_recu&id_frais=<?php echo $data2['id_frais'] ?>" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b ui-btn-icon-left ui-icon-check" id="confirm" rel="external">Confirmer</a>
</div>
</div>
<?php
}
?>
  
  <?php 
$query=$db->prepare('SELECT*  FROM kartable_frais_scolaire LEFT JOIN kartable_eleves
ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve WHERE erreur_signalee = "oui"
ORDER BY date_paiement DESC');
$query->execute();

while ($data3 = $query->fetch())
{
    ?>

<div data-role="popup" id="sup<?php echo $data3['id_frais']; ?>" data-overlay-theme="b" data-dismissible="false" style="max-width:400px;">

<div role="main" class="ui-content" style="background-color:white;">
    <h2 class="ui-title" style="color: black;font-size: 18px;">Confirmez-vous de supprimer ce reçu ?</h2>
<hr>
<div style="text-align: center;color: red;"><i class="fa fa-danger"></i> Attention ! Cette action est irréversible ..</div>
<br>
<div style="text-align: center;">
    <a href="#" class="ui-btn ui-corner-all ui-btn-inline ui-btn-c ui-btn-icon-left ui-icon-delete" data-rel="back" style="color: black;">Annuler</a>
    
    <a href="../kartable_moteur.php?action=supprimer_recu&id_frais=<?php echo $data3['id_frais'] ?>" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b ui-btn-icon-left ui-icon-alert" id="confirm" rel="external">Confirmer</a>
    </div>
</div>
</div>
<?php
}
?>
        </div>
          </div>
          </div>
          </body>
    </html>