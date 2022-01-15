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
 <script>
                function PrintDiv() {

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

  <div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->

  <div class="ui-corner-all custom-corners">
  <div class="ui-bar ui-bar-a">
    <h3>Contrôle et historique des frais</h3>
  </div>
  <div class="ui-body ui-body-<?php echo $theme;?>">
 
 
<?php
$all=$db->prepare('SELECT*  FROM kartable_modalite');
$all->execute();

while ($dataAll = $all->fetch())
{
  ?>
    <span style="font-size: 17px;font-weight: bold;"><?php echo $dataAll['modalite']. ' :  <a href="#"> '.$dataAll['montant_modalite'].'$</a>' ;?></span>
&nbsp;&nbsp;&nbsp;
<?php } ?>   
  </div>
</div>
<br>
  <div class="ui-grid-a">
    <div class="ui-block-a">
    
      <fieldset id="Motif" data-role="collapsible" data-theme="<?php echo $theme;?>">
    <legend>Filtrer par date / noms</legend>

    <form action="cmp_ctrl_promo_date.php" method="post" name="formFilter">  
  <label for="filtre_date" data-theme="a">&Aacute; partir :</label>
  <input type="date" name="filtre_date1" id="" value=""  data-theme="d"/>

  <label for="filtre_date" data-theme="a">Jusqu'au :</label>
  <input type="date" name="filtre_date2" id="" value=""  data-theme="d"/>

  <a href="#" onclick="document.formFilter.submit()" class="ui-input-btn ui-btn ui-btn-b ui-corner-all ui-shadow" style="width: 100px;" rel="external">Filtrer</a>
</form>

</form>
<br>
<form action="filtre_paiement_nom.php" method="post">

<label for="" style="font-weight: bold; font-size: 17px;"><i class="fa fa-user"></i> Nom de l'élève : </label> 
     <ul data-role="listview" data-filter="true" data-filter-reveal="true" data-filter-placeholder="Recherche ..." data-inset="true" data-theme="d">
<?php
 $query=$db->prepare('SELECT*  FROM kartable_eleves');
 $query->execute();
while ($data = $query->fetch())
{?>
   <li>
   <a href="filtre_paiement_nom.php?nom_eleve=<?php echo $data['noms_eleve']?>&id_eleve=<?php echo $data['id_eleve']?>" class="ui-input-btn ui-btn ui-btn-c ui-icon-user ui-btn-icon-left ui-shadow-icon" rel="external"><span style="color:black;"><?php echo $data['noms_eleve']; ?>
   <label>
   <input type="checkbox" name="<?php echo $data['noms_eleve']?>" id="<?php echo $data['id_eleve']?>" value="<?php echo $data['id_eleve']?>">Selectionner
   </label>
  
   </span>
   </a>   
   </li><p>
<?php 
}?>
</ul>
</form>
</fieldset>
</div>

<div class="ui-block-b">

<fieldset data-role="collapsible" data-theme="<?php echo $theme;?>">
    <legend>Filtrer par Classe / Modalité</legend>
    <form method="POST" action="filtre_paiement_classe.php" name="forms" id="forms">  
<div class="ui-field-contain">
    <select name="classe" id="select-native-1">
    <option value="">Filtrer par classe</option>
    <?php
$query=$db->prepare('SELECT*  FROM kartable_promotion');
$query->execute();
while ($dataOptions = $query->fetch())
{
  if($dataOptions['classe_promo'] == 1)
  {
?>
        <option value="<?php echo $dataOptions['id_promotion']; ?>"><?php echo $dataOptions['classe_promo'].' ière '.$dataOptions['option_promo']; ?></option>
<?php
  }
  else{
  ?>
        <option value="<?php echo $dataOptions['id_promotion']; ?>"><?php echo $dataOptions['classe_promo'].' ième '.$dataOptions['option_promo']; ?></option>
<?php 
}
} ?>
    </select>
    <a href="#" onclick="document.forms.submit();" rel="external" style="width: 100px;" class="ui-btn ui-btn-b ui-corner-all ui-shadow ui-btn-b">Filtrer</a>   
</div>
</form>

<form method="POST" action="filtre_paiement_modalite.php" name="formodalite">  
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
  <a href="#" onclick="document.formodalite.submit();" rel="external" style="width: 100px;" class="ui-btn ui-btn-b ui-corner-all ui-shadow ui-btn-b">Filtrer</a>   
</div>
</form>

    </fieldset>
    </div>

    </div> <!--End of grid!-->


<p></p><br>

<a href="#" onclick="PrintDiv();" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-action" style="width: 80px;">Imprimer</a>

<?php
$req=$db->prepare('SELECT*  FROM kartable_frais_scolaire LEFT JOIN kartable_eleves
ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve WHERE erreur_signalee = ""
ORDER BY id_frais DESC');
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

$solde=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "Solde"');
$solde->execute();
$dataSolde = $solde->fetch();

while ($data1 = $req->fetch())
{
  $dette = $dataSolde['montant_modalite'] - $data1['montant'];

    echo '<tr>' . "\n";  
    echo '<td style="font-weight: bold;">' . $data1['id_frais'] . '</td>' . "\n"; 
    echo '<td style="font-weight: bold;">' . $data1['noms_eleve'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['montant'] .$data1['devise'].'</td>' ."\n";
    echo '<td style="font-weight: bold;">' . $data1['motif'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['modalite'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['date_paiement'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">'. $dette.'</td>' . "\n";
    echo '<td style="font-weight: bold;"> <a href="./cmp_print_recu_frais.php?id_eleve='.$data1['id_eleve'].'&id_frais='.$data1['id_frais'].'" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-plus" style="width: 80px;"  rel="external" data-ajax="false">Ouvrir</a>
    </td>' . "\n";
    echo '</tr>' . "\n";
} 
echo '</tbody>';
echo '</table>' . "\n";
?>
</div>

          </div>
          

<div data-role="page" id="divToPrint" style="width: 100%;">
          
<file-header></file-header>
<?php include("./cmp_file_header.php"); ?>

          <h4 style="text-align: center;font-weight; bold;">Historique des frais scolaires pour l'année <?php echo $annee_scolaire; ?></h4>
    <?php
          $req=$db->prepare('SELECT*  FROM kartable_frais_scolaire LEFT JOIN kartable_eleves
          ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve WHERE erreur_signalee = ""
          ORDER BY date_paiement DESC');
          $req->execute();
          
          echo '<table class="table table-bordered" style="font-size: 10px;">' . "\n"; 
          
          echo '<thead style="color: #3388cc;">
          <tr>';
          
          echo "<th data-priority='1'>id paiement</th>
                <th>Noms de l'élève</th>
                <th>Montant payé</th>
                <th>Devise</th>
                <th>Motif</th>
                <th>Modalité</th>
                <th>Date</th>
                <th>Dette</th>";
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
              echo '<td style="font-weight: bold;">' . $data1['montant'] . '</td>' . "\n";
              echo '<td style="font-weight: bold;">' . $data1['devise'] . '</td>' . "\n";
              echo '<td style="font-weight: bold;">' . $data1['motif'] . '</td>' . "\n";
              echo '<td style="font-weight: bold;">' . $data1['modalite'] . '</td>' . "\n";
              echo '<td style="font-weight: bold;">' . $data1['date_paiement'] . '</td>' . "\n";
              echo '<td style="font-weight: bold;">'. $dette.'</td>' . "\n";
              
              echo '</tr>' . "\n";
          } 
          echo '</tbody>';
          echo '</table>' . "\n";
          ?>
          </div>
          
                    </div>
                    <script src="../main.js"></script>   
          </body>
    </html>