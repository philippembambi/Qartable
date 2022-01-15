<?php
require('../database.php');
include('../kartable_debut.php');
?>
<!DOCTYPE html>
<html lang="en">
  <?php require('header_files.html'); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
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
<div data-role="page" class="jqm-demos ui-responsive-panel" data-theme="<?php echo $theme; ?>" id="page1" data-title="Historique de paie">

  <div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->

  <div class="ui-corner-all custom-corners">
  <div class="ui-bar ui-bar-<?php echo $theme; ?>">
    <h3>Historique de paie</h3>
  </div>

  <div class="ui-grid-a">
    <div class="ui-block-a">
    
      <fieldset id="Motif" data-role="collapsible" data-theme="<?php echo $theme; ?>">
    <legend>Filtrer par mois / Type de rémunération</legend>

    <form action="./filtre_salaire_by_date.php" method="post">  
  <label for="filtre_date" data-theme="a">Mois de :</label>
  <input type="date" name="filtre_date1" id="filtre_date1" value=""  data-theme="d"/>

<button class="ui-input-btn ui-btn ui-btn-b ui-corner-all ui-shadow" style="width: 100px;" rel="external">Filtrer</button>
</form>


<form method="POST" action="./filtre_salaire_by_object.php" name="">  
<div class="ui-field-contain">
    <select name="modalite" id="select-native-1" data-theme="<?php echo $theme; ?>">
    <option value="salaire">Salaire</option>
  <option value="prime">Prime</option>
    </select>
    <button rel="external" onclick="" style="width: 100px;" class="ui-btn ui-corner-all ui-shadow ui-btn-b">Filtrer</button>    
</div>
</form>

</fieldset>
</div>

<div class="ui-block-b">

<fieldset data-role="collapsible" data-theme="<?php echo $theme; ?>">
    <legend>Filtrer par nom du personnel</legend>

    <form method="POST" action="filtre_salaire_by_nom_personnel.php" name="forms" id="forms">  

<div class="ui-field-contain">
    <select name="personnel" id="select-native-1">
    <?php
$query=$db->prepare('SELECT*  FROM kartable_personnel');
$query->execute();
while ($data_personnel = $query->fetch())
{
?>
        <option value="<?php echo $data_personnel['id_personel']; ?>"><?php echo $data_personnel['noms_personel']; ?></option>
<?php
} ?>
    </select>
    <button rel="external" onclick="" style="width: 100px;" class="ui-btn ui-btn-b ui-corner-all ui-shadow ui-btn-b" style="width: 200px;">Filtrer</button>    
</div>
</form>
</fieldset>
</div>


<p></p><br>

<a href="#" onclick="PrintDiv();" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-action" style="width: 100px;">Imprimer</a>

<!--<a href="./kartable_print_pdf.php?action=print_salaire_story" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-action" style="width: 80px;">Imprimer</a>-->
<br>
<?php
$req=$db->prepare('SELECT*  FROM kartable_remuneration LEFT JOIN kartable_personnel
ON kartable_remuneration.id_personnel = kartable_personnel.id_personel 
GROUP BY date_rem ORDER BY date_rem DESC');
$req->execute();

echo $tab2_color; 

echo '<thead style="color: #3388cc;">
<tr>';

echo "<th data-priority='1'>id rem</th>
      <th>Noms du salarié</th>
      <th>Motif</th>
      <th>Date</th>
      <th>Somme</th>
      <th>Note</th>
      <th>Action</th>";
echo '</tr></thead><tbody>';

while ($data1 = $req->fetch())
{
    if($data1['devise_rem'] == "usd")
    {
        $exchange_rate = "$";
    }
    elseif($data1['devise_rem'] == "fc")
    {
        $exchange_rate = "FC";
    }
    else{
        $exchange_rate = "Francs";
    }
    echo '<tr>' . "\n";  
    echo '<td style="font-weight: bold;">' . $data1['id_rem'] . '</td>' . "\n"; 
    echo '<td style="font-weight: bold;">' . $data1['noms_personel'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['type_rem'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['date_rem'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['montant_rem'] .' '.$exchange_rate. '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['desc_rem'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;"> <a href="./cmp_bordereau_paie.php?id_personel='.$data1['id_personel'].'&id_rem='.$data1['id_rem'].'" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-plus" style="width: 80px;"  rel="external" data-ajax="false">Ouvrir</a>
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

          <h4 style="text-align: center;font-weight; bold;">Historique de paie des salariés</h4>
   
          <?php
$req=$db->prepare('SELECT*  FROM kartable_remuneration LEFT JOIN kartable_personnel
ON kartable_remuneration.id_personnel = kartable_personnel.id_personel 
ORDER BY date_rem DESC');
$req->execute();

echo '<table class="table table-bordered" style="font-size: 10px;">' . "\n"; 

echo '<thead style="color: #3388cc;">
<tr>';

echo "<th data-priority='1'>id rem</th>
      <th>Noms</th>
      <th>Motif</th>
      <th>Date</th>
      <th>Somme</th>
      <th>Note</th>";
echo '</tr></thead><tbody>';

while ($data1 = $req->fetch())
{
    if($data1['devise_rem'] == "usd")
    {
        $exchange_rate = "$";
    }
    elseif($data1['devise_rem'] == "fc")
    {
        $exchange_rate = "FC";
    }
    else{
        $exchange_rate = "Francs";
    }
    echo '<tr>' . "\n";  
    echo '<td style="font-weight: bold;">' . $data1['id_rem'] . '</td>' . "\n"; 
    echo '<td style="font-weight: bold;">' . $data1['noms_personel'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['type_rem'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['date_rem'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['montant_rem'] .' '.$exchange_rate. '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['desc_rem'] . '</td>' . "\n";
    echo '</tr>' . "\n";
} 
echo '</tbody>';
echo '</table>' . "\n";
?>
</div>
<script src="../main.js"></script>
          </body>
          <!--philippembambi413@gmail.com-->
    </html>