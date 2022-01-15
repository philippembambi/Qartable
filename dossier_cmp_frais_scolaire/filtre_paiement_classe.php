<?php
require('../database.php');
include('../kartable_debut.php');

if(isset($_POST['classe']))
{
$id_classe = $_POST['classe'];
}
else{
  $id_classe = $_GET['classe'];
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
		<h1 style="font-size: 20px;">Paiement pour la  <?php echo $classe_promo. ' '. $option_promo; ?></span></h1>
		<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" rel="external" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-ajax="false">Back</a>
  	<a href="#" onclick="window.location.reload();" rel="external" data-shadow="false" data-iconshadow="false" data-icon="recycle" data-iconpos="notext" data-ajax="false">Back</a>
  
    </div><!-- /header -->

  <div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->

  <div class="ui-grid-a">
    <div class="ui-block-a">
    
      <fieldset id="Motif" data-role="collapsible" data-theme="<?php echo $theme; ?>">
    <legend>Filtrer par date</legend>

    <form action="filtre_paiement_classe_date.php?classe=<?php echo $id_classe ?>" method="post" name="forms">  
  <label for="filtre_date" data-theme="a">&Aacute; partir :</label>
  <input type="date" name="filtre_date1" id="" value=""  data-theme="d"/>

  <label for="filtre_date" data-theme="a">Jusqu'au :</label>
  <input type="date" name="filtre_date2" id="" value=""  data-theme="d"/>

  <a href="#" onclick="document.forms.submit();" rel="external" style="width: 100px;" class="ui-btn ui-btn-b ui-corner-all ui-shadow ui-btn-b">Filtrer</a>   
</form>

</form>

</fieldset>
</div>

<div class="ui-block-b">

<fieldset data-role="collapsible" data-theme="<?php echo $theme; ?>">
    <legend>Filtrer par Modalité / Montant</legend>

<form method="POST" action="filtre_paiement_classe_modalite.php?classe=<?php echo $id_classe; ?>" name="modalites">  
<div class="ui-field-contain">
    <select name="modalite" id="select-native-1">
    <option value="">Filtrer par modalité</option>
    <?php
$mod=$db->prepare('SELECT*  FROM kartable_modalite');
$mod->execute();
while ($dataMod = $mod->fetch())
{ 
  ?>
  <option value="<?php echo $dataMod['modalite']; ?>"><?php echo $dataMod['modalite']; ?></option>
<?php 
} ?>
    </select>
    <a href="#" onclick="document.modalites.submit();" rel="external" style="width: 100px;" class="ui-btn ui-btn-b ui-corner-all ui-shadow ui-btn-b">Filtrer</a>   

</div>
</form>
<br>

<form action="filtre_paiement_classe_montant.php?classe=<?php echo $id_classe ?>" method="post" name="montants">  
  <label for="filtre_date" data-theme="a">Filtrer par montant <span style="color: red;"><i>( ceux qui ont payé au moins)</i></span> :</label>
  <input type="number" name="montant" id="" value=""  data-theme="d"/>

  <a href="#" onclick="document.montants.submit();" rel="external" style="width: 100px;" class="ui-btn ui-btn-b ui-corner-all ui-shadow ui-btn-b">Filtrer</a>   
</form>

</form>

    </fieldset>
    </div>

    </div> <!--End of grid!-->

<br>

<a href="#" onclick="PrintDiv1();" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-action" style="width: 80px;">Imprimer</a>
<!-- <a href="./kartable_print_pdf.php?action=print_fees_by_classe&amp;id_classe=<?php // echo $id_classe; ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-action" style="width: 80px;">Imprimer</a> -->

<?php
$req=$db->prepare('SELECT*  FROM kartable_frais_scolaire LEFT JOIN kartable_eleves
ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve LEFT JOIN kartable_promotion
ON kartable_eleves.promotion_id = kartable_promotion.id_promotion 
WHERE kartable_promotion.id_promotion = :id_classe AND erreur_signalee = "" ');
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

echo '<td style="font-weight: bold;"> <a href="./cmp_print_recu_frais.php?id_eleve='.$data1['id_eleve'].'&id_frais='.$data1['id_frais'].'" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-plus" style="width: 80px;"  rel="external" data-ajax="false">Ouvrir</a>
</td>' . "\n";
echo '</tr>' . "\n";
} 
echo '</tbody>';
echo '</table>' . "\n";
?>

</div>

          </div>
          

          <div data-role="page" id="divToPrint">

          <file-header></file-header>
          <?php include("./cmp_file_header.php"); ?>

          <h4 style="text-align: center;font-weight; bold;">Historique des Frais scolaires en <b><?php echo $classe_promo. ' '. $option_promo; ?></b></h4>
 
            <?php
            $req=$db->prepare('SELECT*  FROM kartable_frais_scolaire LEFT JOIN kartable_eleves
            ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve LEFT JOIN kartable_promotion
            ON kartable_eleves.promotion_id = kartable_promotion.id_promotion 
            WHERE kartable_promotion.id_promotion = :id_classe AND erreur_signalee = "" ');
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

                      <script src="./main.js"></script>
                    </body>
    </html>