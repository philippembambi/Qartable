<?php
require('../database.php');
include('../kartable_debut.php');
?>
<?php
if(isset($_POST['filtre_date']))
{
    $date = $_POST['filtre_date'];
    $timestamp = strtotime($date);
}
$temps = date('d/m/Y',$timestamp);
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
<div data-role="page" class="jqm-demos ui-responsive-panel" data-theme="<?php echo $theme; ?>" id="page1" data-title="Index Kartable">

<div data-role="header" data-theme="<?php echo $theme; ?>">
		<h1 style="font-size: 20px;">Historique de paiement du <?php echo $temps; ?></span></h1>
    <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" rel="external" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-ajax="false">Back</a>
  	<a href="#" onclick="window.location.reload();" rel="external" data-shadow="false" data-iconshadow="false" data-icon="recycle" data-iconpos="notext" data-ajax="false">Back</a>
  
    </div><!-- /header -->

  <div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->

<?php
$real_date = str_replace('-', '/', $date);

$req=$db->prepare('SELECT*  FROM kartable_frais_scolaire LEFT JOIN kartable_eleves
ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
WHERE kartable_frais_scolaire.date_paiement = :temps');
$req->bindValue(':temps', $real_date, PDO::PARAM_STR);
$req->execute();

echo $tab2_color; 

echo '<thead style="color: #3388cc;">
<tr>';

echo "<th data-priority='1'>id paiement</th>
      <th>Noms de l'élève</th>
      <th>Montant payé</th>
      <th>Motif</th>
      <th>Modalité</th>
      <th>Dette</th>
      <th>Action</th>";
echo '</tr></thead><tbody>';

$solde=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "Accompte"');
$solde->execute();
$dataAccompte = $solde->fetch();

$tranche1=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "tranche1"');
$tranche1->execute();
$dataTranche1 = $tranche1->fetch();

$tranche2=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "tranche2"');
$tranche2->execute();
$dataTranche2 = $tranche2->fetch();

$tranche3=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "Solde"');
$tranche3->execute();
$dataTranche3 = $tranche3->fetch();

while ($data1 = $req->fetch())
{
//  $timestamp = strtotime($data1['date_paiement']);
  //$date_time = date('d/m/Y',$timestamp);
  $reqEleve=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve AND kartable_frais_scolaire.modalite = "Accompte" ');
  $reqEleve->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve->execute();
  $data3 = $reqEleve->fetch();
  $dette1 = $dataAccompte['montant_modalite'] - $data3['dette'];
  
  $reqEleve2=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve AND kartable_frais_scolaire.modalite = "tranche1" ');
  $reqEleve2->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve2->execute();
  $data4 = $reqEleve2->fetch();
  $dette2 = $dataTranche1['montant_modalite'] - $data4['dette'];
  
  $reqEleve3=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve AND kartable_frais_scolaire.modalite = "tranche2" ');
  $reqEleve3->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve3->execute();
  $data5 = $reqEleve3->fetch();
  $dette3 = $dataTranche2['montant_modalite'] - $data5['dette'];
  
  $reqEleve4=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve');
  $reqEleve4->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve4->execute();
  $data6 = $reqEleve4->fetch();
  $dette4 = $dataTranche3['montant_modalite'] - $data6['dette'];

    echo '<tr>' . "\n";  
    echo '<td style="font-weight: bold;">' . $data1['id_frais'] . '</td>' . "\n"; 
    echo '<td style="font-weight: bold;">' . $data1['noms_eleve'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['montant'] . $data1['devise'] .'</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['motif'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['modalite'] . '</td>' . "\n";

    if($data1['modalite'] == "Accompte")
    {
      echo '<td style="font-weight: bold;">' . $dette1 . '</td>' . "\n";
    }
    elseif($data1['modalite'] == "tranche1")
    {
      echo '<td style="font-weight: bold;">' . $dette2 . '</td>' . "\n";
    }
    elseif($data1['modalite'] == "tranche2")
    {
      echo '<td style="font-weight: bold;">' . $dette3 . '</td>' . "\n";
    }
    elseif($data1['modalite'] == "Solde")
    {
      echo '<td style="font-weight: bold;">' . $dette4 . '</td>' . "\n";
    }
    else{
      echo '<td style="font-weight: bold;">' . $dette4 . '</td>' . "\n";
    }
    
    echo '<td style="font-weight: bold;"> <a href="./cmp_print_recu_frais.php?id_eleve='.$data1['id_eleve'].'&id_frais='.$data1['id_frais'].'" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-plus" style="width: 80px;"  rel="external" data-ajax="false">Ouvrir</a>
    </td>' . "\n";
 
    echo '</tr>' . "\n";
} 
echo '</tbody>';
echo '</table>' . "\n";
?>

</div>

          </div>
          </div>
          </body>
    </html>