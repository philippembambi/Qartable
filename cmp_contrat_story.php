<?php
require('database.php');
include('kartable_debut.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
<!--Css Jquey mobile-->
    <link rel="stylesheet" href="jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
    <link rel="stylesheet" href="assets/css/jqm-demos.css">

    <link rel="stylesheet" href="./addStyle.css">
    <link rel="stylesheet" href="./css/theme_classic.css">

   <!--Vue.js--> 
  <script src="CodeJs/vue.js"> </script>
  <script src="managerJs/validation.js"></script>
  <script src="./kartable_ajax.js"></script>
  
<!--Js Jquery mobile-->
    <script src="jquery-2.1.1.min.js"></script>
    <script src="jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <script>
  
$.mobile.document.on( "pagebeforeshow", function(){
  make_sleep();

});
  </script>
</head>
<body>
<div data-role="header" data-theme="<?php echo $theme; ?>">
		<h1 style="font-size: 20px;">Historique des contrats</span></h1>
		<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" rel="external" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-ajax="false">Back</a>
  	<a href="#" onclick="window.location.reload();" rel="external" data-shadow="false" data-iconshadow="false" data-icon="recycle" data-iconpos="notext" data-ajax="false">Back</a>
  
  </div><!-- /header -->


  <div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->


<?php
$req=$db->prepare('SELECT*  FROM kartable_contrat ORDER BY id_contrat ASC');
$req->execute();

echo $tab1_color; 

echo '<thead style="color: #3388cc;background-color: white;">
<tr>';

echo "<th data-priority='1'>Id Contrat</th>
      <th data-priority='2'>Responsable</th>
      <th data-priority='3'>Date début</th>
      <th data-priority='4'>&Eacute;chéance</th>
      <th data-priority='5'>Observation</th>
      <th>Action</th>";
echo '</tr></thead><tbody>';

while ($data1 = $req->fetch())
{
    echo '<tr>' . "\n";  
    echo '<td style="font-weight: bold;">' . $data1['id_contrat'] . '</td>' . "\n"; 
    echo '<td style="font-weight: bold;">' . $data1['noms_responsable'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['date_debut'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['echeance_contrat'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['observation'] . '</td>' . "\n";
    

    echo '<td style="font-weight: bold;"> <a href="./kartable_promo.php?Maclasse='.$data1['id_contrat'].'&Masection='.$data1['id_contrat'].'" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-action" style="width: 80px;"  rel="external" data-ajax="false">Imprimer</a>
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