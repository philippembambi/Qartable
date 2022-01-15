<?php
require('../database.php');
include("../kartable_debut.php");
?>
<?php
if(isset($_POST['filtre_date1']))
{
    $date = $_POST['filtre_date1'];
    $timestamp = strtotime($date);
}
$temps1 = date('Y/m',$timestamp);
$temps2 = date('m/Y',$timestamp);
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
popupWin.document.write('<html><head><link rel="stylesheet" href="jquery.mobile-1.4.5/jquery.mobile-1.4.5.css"><link rel="stylesheet" href="./css/theme_classic.css"><link rel="stylesheet" href="./css/bootstrap.css"></head><body onload="window.print()">' +
  divToPrint.innerHTML + '</html>');
popupWin.document.close();
}
  </script>
</head>
<body>
<div data-role="page" class="jqm-demos ui-responsive-panel" data-theme="<?php echo $theme; ?>" id="page1" data-title="Index Kartable">

<div data-role="header" data-theme="<?php echo $theme; ?>">
		<h1 style="font-size: 20px;">Historique de paiement du <?php echo $temps2; ?></span></h1>
		<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" rel="external" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext">Back</a>
  	<a href="#" onclick="window.location.reload();" rel="external" data-shadow="false" data-iconshadow="false" data-icon="recycle" data-iconpos="notext" data-ajax="false">Back</a>
  
    </div><!-- /header -->

  <div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->

<a href="#" onclick="PrintDiv();" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-action" style="width: 80px;">Imprimer</a>
<!--  <a href="./kartable_print_pdf.php?action=print_payement_by_month&amp;month=<?php //echo $temps1; ?>&amp;month2=<?php //echo $temps2; ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-action" style="width: 80px;">Imprimer</a> -->

<?php
$req=$db->prepare('SELECT*  FROM kartable_remuneration LEFT JOIN kartable_personnel
ON kartable_remuneration.id_personnel = kartable_personnel.id_personel WHERE kartable_remuneration.mois_rem = :mois
ORDER BY date_rem DESC');
$req->bindValue(':mois', $temps1, PDO::PARAM_STR);
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
    echo '<td style="font-weight: bold;"> <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-plus" style="width: 80px;"  rel="external" data-ajax="false">Plus</a>
    </td>' . "\n";
    echo '</tr>' . "\n";
} 
echo '</tbody>';
echo '</table>' . "\n";
?>
</div>

          </div>
          </div>
          
          <div data-role="page" id="divToPrint" style="width: 100%;">
          
<file-header></file-header>
<?php include("./cmp_file_header.php"); ?>

          <h4 style="text-align: center;font-weight; bold;">Historique de paiement du <?php echo $temps1; ?></h4>

          <?php
$req=$db->prepare('SELECT*  FROM kartable_remuneration LEFT JOIN kartable_personnel
ON kartable_remuneration.id_personnel = kartable_personnel.id_personel WHERE kartable_remuneration.mois_rem = :mois
ORDER BY date_rem DESC');
$req->bindValue(':mois', $temps1, PDO::PARAM_STR);
$req->execute();

echo '<table class="table table-bordered" style="font-size: 10px;">' . "\n"; 

echo '<thead style="color: #3388cc;">
<tr>';

echo "<th data-priority='1'>id</th>
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
          <script src="./main.js"></script>
          </body>
    </html>