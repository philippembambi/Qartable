<?php
require('../database.php');
include('../kartable_debut.php');
if(isset($_GET['classe']))
{
$id_classe = $_GET['classe'];
}
else{
  $id_classe = 0;
}

$filtre_date1 = $_POST['filtre_date1'];
$filtre_date1 = str_replace('-', '/', $filtre_date1);

$timestamp1 = strtotime($filtre_date1);
$date1 = date('d/m/Y',$timestamp1);


if(empty($_POST['filtre_date2']))
{
  $now = time();
  $filtre_date2 = date('Y/m/d',$now);
  $date2 = date('d/m/Y',$now);
}
else{
  $filtre_date2 = $_POST['filtre_date2'];
  $filtre_date2 = str_replace('-', '/', $filtre_date2);
  
  $timestamp2 = strtotime($filtre_date2);
  $date2 = date('d/m/Y',$timestamp2);     
}


$requete=$db->prepare('SELECT*  FROM kartable_frais_scolaire LEFT JOIN kartable_eleves
ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve LEFT JOIN kartable_promotion
ON kartable_eleves.promotion_id = kartable_promotion.id_promotion 
WHERE kartable_promotion.id_promotion = :id_classe');
$requete->bindValue(':id_classe', (int) $id_classe, PDO::PARAM_INT);
$requete->execute();
$data = $requete->fetch();
$classe_promo = ($data['classe_promo'] > 1 )?($data['classe_promo']." ième"):($data['classe_promo']." ière année");
$option_promo = $data['option_promo'];
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

function PrintDiv1() {
var divToPrint = document.getElementById('divToPrint');
var popupWin = window.open('', '_blank', 'width=1500,height=1500');
popupWin.document.open();
popupWin.document.write('<html><head><link rel="stylesheet" href="../jquery.mobile-1.4.5/jquery.mobile-1.4.5.css"><link rel="stylesheet" href="../css/theme_classic.css"><link rel="stylesheet" href="../css/bootstrap.css"></head><body onload="window.print()">' +
  divToPrint.innerHTML + '</html>');
popupWin.document.close();
}
  </script>
</head>
<body>
<div data-role="page" class="jqm-demos ui-responsive-panel" data-theme="<?php echo $theme; ?>" id="page1" data-title="Index Kartable">

<div data-role="header" data-theme="<?php echo $theme; ?>">
		<h1 style="font-size: 20px;"><?php echo $classe_promo. ' '. substr($option_promo, 0, 4); ?>.. du <a href="#"><?php echo $date1; ?></a> au <a href="#"><?php echo $date2; ?></a></span></h1>
		<a href="filtre_paiement_classe.php?classe=<?php echo $id_classe; ?>" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext">Back</a>
  	<a href="#" onclick="window.location.reload();" rel="external" data-shadow="false" data-iconshadow="false" data-icon="recycle" data-iconpos="notext" data-ajax="false">Back</a>
  
    </div><!-- /header -->

  <div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->

  <a href="#" onclick="PrintDiv1();" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-action" style="width: 80px;">Imprimer</a>

<?php
$req=$db->prepare('SELECT*  FROM kartable_frais_scolaire LEFT JOIN kartable_eleves
ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve LEFT JOIN kartable_promotion
ON kartable_eleves.promotion_id = kartable_promotion.id_promotion 
WHERE (kartable_frais_scolaire.date_paiement BETWEEN :date1 AND :date2) AND (kartable_promotion.id_promotion = :id_classe)');
$req->bindValue(':date1', $filtre_date1, PDO::PARAM_STR);
$req->bindValue(':date2', $filtre_date2, PDO::PARAM_STR);
$req->bindValue(':id_classe', (int) $id_classe, PDO::PARAM_INT);
$req->execute();

echo $tab2_color; 

echo '<thead style="color: #3388cc;">
<tr>';

echo "<th data-priority='1'>id paiement</th>
      <th>Noms de l'élève</th>
      <th>Montant payé</th>
      <th>Motif</th>
      <th>Modalité</th>
      <th>Date</th>
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
  
  $timestamp = strtotime($data1['date_paiement']);
  $date_time = date('d/m/Y',$timestamp);
 
    echo '<tr>' . "\n";  
    echo '<td style="font-weight: bold;">' . $data1['id_frais'] . '</td>' . "\n"; 
    echo '<td style="font-weight: bold;">' . $data1['noms_eleve'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['montant'] . $data1['devise'] .'</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['motif'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['modalite'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $date_time . '</td>' . "\n";
    
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

echo '<td style="font-weight: bold;"> <a href="../cmp_print_recu_frais.php?id_eleve='.$data1['id_eleve'].'&id_frais='.$data1['id_frais'].'" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-plus" style="width: 80px;"  rel="external" data-ajax="false">Ouvrir</a>
</td>' . "\n";
echo '</tr>' . "\n";
} 
echo '</tbody>';
echo '</table>' . "\n";
?>

</div>

          </div>
          </div>

          <div data-role="page" id="divToPrint">

<file-header></file-header>
<?php include("./cmp_file_header.php"); ?>

<h4 style="text-align: center;font-weight; bold;">Frais scolaires en <?php echo $classe_promo. ' '. $option_promo; ?> du <a href="#"><?php echo $date1; ?></a> au <a href="#"><?php echo $date2; ?></a></h4>

<?php
$req=$db->prepare('SELECT*  FROM kartable_frais_scolaire LEFT JOIN kartable_eleves
ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve LEFT JOIN kartable_promotion
ON kartable_eleves.promotion_id = kartable_promotion.id_promotion 
WHERE (kartable_frais_scolaire.date_paiement BETWEEN :date1 AND :date2) AND (kartable_promotion.id_promotion = :id_classe)');
$req->bindValue(':date1', $filtre_date1, PDO::PARAM_STR);
$req->bindValue(':date2', $filtre_date2, PDO::PARAM_STR);
$req->bindValue(':id_classe', (int) $id_classe, PDO::PARAM_INT);
$req->execute();

echo '<table class="table table-bordered" style="font-size: 10px;">' . "\n"; 

echo '<thead style="color: #3388cc;">
<tr>';

echo "<th data-priority='1'>id paiement</th>
      <th>Noms de l'élève</th>
      <th>Montant payé</th>
      <th>Motif</th>
      <th>Modalité</th>
      <th>Date</th>
      <th>Dette</th>";
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
  
  $timestamp = strtotime($data1['date_paiement']);
  $date_time = date('d/m/Y',$timestamp);
 
    echo '<tr>' . "\n";  
    echo '<td style="font-weight: bold;">' . $data1['id_frais'] . '</td>' . "\n"; 
    echo '<td style="font-weight: bold;">' . $data1['noms_eleve'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['montant'] . $data1['devise'] .'</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['motif'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['modalite'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $date_time . '</td>' . "\n";
    
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

echo '</tr>' . "\n";
} 
echo '</tbody>';
echo '</table>' . "\n";
?>
</div>

<script src="../main.js"></script>
          </body>
    </html>