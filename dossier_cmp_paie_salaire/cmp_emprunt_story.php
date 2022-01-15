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

    <?php require('header_files.html'); ?>
<script>
  
$.mobile.document.on( "pagebeforeshow", function(){
  make_sleep();
});

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
<div data-role="page" class="jqm-demos ui-responsive-panel" data-theme="<?php echo $theme; ?>" id="page1" data-title="Emprunts">

  <div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->

  <div class="ui-corner-all custom-corners">
  <div class="ui-bar ui-bar-c">
    <h3>Historique des emprunts</h3>
  </div>

      <fieldset id="Motif" data-role="collapsible" data-theme="<?php echo $theme; ?>">
    <legend>Filtrer par date</legend>

    <form action="cmp_ctrl_promo_date.php" method="post" rel="external">
  <input type="date" name="filtre_date1" id="" value=""  data-theme="d"/>

<button class="ui-input-btn ui-btn ui-btn-b ui-corner-all ui-shadow" style="width: 100px;" rel="external">Filtrer</button>
</form>
</fieldset>


<p></p><br>

<a href="#" onclick="PrintDiv();" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-action" style="width: 80px;">Imprimer</a>
<!--<a href="./kartable_print_pdf.php?action=print_historique_emprunt" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-action" style="width: 80px;">Imprimer</a>-->

<?php
$req=$db->prepare('SELECT*  FROM kartable_emprunt LEFT JOIN kartable_personnel
ON kartable_emprunt.id_personnel = kartable_personnel.id_personel 
ORDER BY date_emp DESC');
$req->execute();

echo $tab2_color; 

echo '<thead style="color: #3388cc;">
<tr>';

echo "<th data-priority='1'>Id</th>
      <th>Noms du personnel</th>
      <th>Date</th>
      <th>Montant</th>
      <th>Note</th>
      <th>Administrateur</th>
      <th>Action</th>";
echo '</tr></thead><tbody>';

while ($data1 = $req->fetch())
{
    if($data1['devise_emp'] == "usd")
    {
        $exchange_rate = "$";
    }
    elseif($data1['devise_emp'] == "fc")
    {
        $exchange_rate = "FC";
    }
    else{
        $exchange_rate = "Francs";
    }
    echo '<tr>' . "\n";  
    echo '<td style="font-weight: bold;">' . $data1['id_emp'] . '</td>' . "\n"; 
    echo '<td style="font-weight: bold;">' . $data1['noms_personel'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['date_emp'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['montant_emp'] .' '.$exchange_rate. '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['note_emp'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['id_admin'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;"> <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-edit" style="width: 80px;"  rel="external" data-ajax="false">Ouvrir</a>
    </td>' . "\n";
    echo '</tr>' . "\n";
} 
echo '</tbody>';
echo '</table>' . "\n";
?>
</div>

          </div>
          </div>
          </div>
         
          <div data-role="page" id="divToPrint" style="width: 100%;">
          
          <file-header></file-header>
          <?php include("./cmp_file_header.php"); ?>

          <h4 style="text-align: center;font-weight; bold;">Historique des emprunts éffectués par les salariés</h4>

          <?php
$req=$db->prepare('SELECT*  FROM kartable_emprunt LEFT JOIN kartable_personnel
ON kartable_emprunt.id_personnel = kartable_personnel.id_personel 
ORDER BY date_emp DESC');
$req->execute();

echo '<table class="table table-bordered" style="font-size: 10px;">' . "\n"; 

echo '<thead style="color: #3388cc;">
<tr>';

echo "<th data-priority='1'>Id</th>
      <th>Noms du personnel</th>
      <th>Date</th>
      <th>Montant</th>
      <th>Note</th>
      <th>Administrateur</th>";
echo '</tr></thead><tbody>';

while ($data1 = $req->fetch())
{
    if($data1['devise_emp'] == "usd")
    {
        $exchange_rate = "$";
    }
    elseif($data1['devise_emp'] == "fc")
    {
        $exchange_rate = "FC";
    }
    else{
        $exchange_rate = "Francs";
    }
    echo '<tr>' . "\n";  
    echo '<td style="font-weight: bold;">' . $data1['id_emp'] . '</td>' . "\n"; 
    echo '<td style="font-weight: bold;">' . $data1['noms_personel'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['date_emp'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['montant_emp'] .' '.$exchange_rate. '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['note_emp'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['id_admin'] . '</td>' . "\n";
    echo '</tr>' . "\n";
} 
echo '</tbody>';
echo '</table>' . "\n";
?>
          </div>
          <script src="../main.js"></script>
          </body>
    </html>