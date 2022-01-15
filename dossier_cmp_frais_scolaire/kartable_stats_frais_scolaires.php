<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <?php require('header_file.html');  ?>
      <!-- Material Design Bootstrap -->
      <link href="../managerCss/mdb.css" rel="stylesheet">
     
  </head>
  <script>
$.mobile.document.on( "pagebeforeshow", function(){
  make_sleep();
});
  </script>

<body>
<div data-role="page" class="jqm-demos ui-responsive-panel" id="" data-title="Statistique de paiment des frais scolaires" data-url="Statistique_frais_scolaires" data-theme="d">

<div data-role="header" data-theme="a">

		<a href="./" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-rel="back" data-ajax="false">Back</a>
        <h2 style="font-size: 18px;font-weight:bold;color: white;">Statistique de paiment des frais scolaires</h2>
	</div><!-- /header -->

<?php
require('../database.php');
require_once("./kartable_graphic_device.php");

$req1=$db->prepare('SELECT SUM(montant) AS nbre_total_frais  FROM kartable_frais_scolaire 
WHERE mois = "9" ');
$req1->execute();
$data1 = $req1->fetch();
$req1->CloseCursor();
$sept = ((int) $data1['nbre_total_frais'] == 0)?(int) $data1['nbre_total_frais'] + 1: (int) $data1['nbre_total_frais'];

$req2=$db->prepare('SELECT SUM(montant) AS nbre_total_frais  FROM kartable_frais_scolaire 
WHERE mois = "10" ');
$req2->execute();
$data2 = $req2->fetch();
$req2->CloseCursor();
$oct = ((int) $data2['nbre_total_frais'] == 0)?(int) $data2['nbre_total_frais'] + 1: (int) $data2['nbre_total_frais'];

$req3=$db->prepare('SELECT SUM(montant) AS nbre_total_frais  FROM kartable_frais_scolaire 
WHERE mois = "11" ');
$req3->execute();
$data3 = $req3->fetch();
$req3->CloseCursor();
$nov = ((int) $data3['nbre_total_frais'] == 0)?(int) $data3['nbre_total_frais'] + 1: (int) $data3['nbre_total_frais'];

$req4=$db->prepare('SELECT SUM(montant) AS nbre_total_frais  FROM kartable_frais_scolaire 
WHERE mois = "12" ');
$req4->execute();
$data4 = $req4->fetch();
$req4->CloseCursor();
$dec = ((int) $data4['nbre_total_frais'] == 0)?(int) $data4['nbre_total_frais'] + 1: (int) $data4['nbre_total_frais'];

$req5=$db->prepare('SELECT SUM(montant) AS nbre_total_frais  FROM kartable_frais_scolaire 
WHERE mois = "1" ');
$req5->execute();
$data5 = $req5->fetch();
$req5->CloseCursor();
$janv = ((int) $data5['nbre_total_frais'] == 0)?(int) $data5['nbre_total_frais'] + 1: (int) $data5['nbre_total_frais'];

$req6=$db->prepare('SELECT SUM(montant) AS nbre_total_frais  FROM kartable_frais_scolaire 
WHERE mois = "2" ');
$req6->execute();
$data6 = $req6->fetch();
$req6->CloseCursor();
$fev = ((int) $data6['nbre_total_frais'] == 0)?(int) $data6['nbre_total_frais'] + 1: (int) $data6['nbre_total_frais'];

$req7=$db->prepare('SELECT SUM(montant) AS nbre_total_frais  FROM kartable_frais_scolaire 
WHERE mois = "3" ');
$req7->execute();
$data7 = $req7->fetch();
$req7->CloseCursor();
$mars = ((int) $data7['nbre_total_frais'] == 0)?(int) $data7['nbre_total_frais'] + 1: (int) $data7['nbre_total_frais'];

$req8=$db->prepare('SELECT SUM(montant) AS nbre_total_frais  FROM kartable_frais_scolaire 
WHERE mois = "4" ');
$req8->execute();
$data8 = $req8->fetch();
$req8->CloseCursor();
$avril = ((int) $data8['nbre_total_frais'] == 0)?(int) $data8['nbre_total_frais'] + 1: (int) $data8['nbre_total_frais'];

$req9=$db->prepare('SELECT SUM(montant) AS nbre_total_frais  FROM kartable_frais_scolaire 
WHERE mois = "5" ');
$req9->execute();
$data9 = $req9->fetch();
$req9->CloseCursor();
$mai = ((int) $data9['nbre_total_frais'] == 0)?(int) $data9['nbre_total_frais'] + 1: (int) $data9['nbre_total_frais'];

$req10=$db->prepare('SELECT SUM(montant) AS nbre_total_frais  FROM kartable_frais_scolaire 
WHERE mois = "6" ');
$req10->execute();
$data10 = $req10->fetch();
$req10->CloseCursor();
$juin = ((int) $data10['nbre_total_frais'] == 0)?(int) $data10['nbre_total_frais'] + 1: (int) $data10['nbre_total_frais'];

$req11=$db->prepare('SELECT SUM(montant) AS nbre_total_frais  FROM kartable_frais_scolaire 
WHERE mois = "7" ');
$req11->execute();
$data11 = $req11->fetch();
$req11->CloseCursor();
$juillet = ($data11['nbre_total_frais'] == 0)? $data11['nbre_total_frais'] + 1: $data11['nbre_total_frais'];

$donn= array($sept, $oct, $nov, $dec, $janv, $fev, $mars, $avril, $mai, $juin, $juillet);

//$donnee= array((int) $jan + 1, 2,3,4,5,6,7,8,9,10,11,12);
$req12=$db->prepare('SELECT SUM(montant) AS somme_total_frais  FROM kartable_frais_scolaire');
$req12->execute();
$data12 = $req12->fetch();
$req12->CloseCursor();
$somme_total_frais = $data12['somme_total_frais'];

$details = "Somme totale : ".$somme_total_frais."$"."                    Moyenne totale pour chaque mois :  ".$somme_total_frais/11;
$texte = array("Septembre", "Octobre", "Novembre", "Decembre", "Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet");
histo(1030,550,$donn,$texte, $details);
?>
<img src="./histo_frais.png" alt="Statistique des frais" style="width: 1O0%;height: 100%;"/>

<?php
function get_ip()
{
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    elseif(isset($_SERVER['HTTP_CLIENT_IP']))
    {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    else
    {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
echo get_ip();
?>