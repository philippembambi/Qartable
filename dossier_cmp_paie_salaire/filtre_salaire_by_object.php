<?php
require('../database.php');
include("../kartable_debut.php");
?>
<?php
if(isset($_POST['modalite']))
{
    $object = $_POST['modalite'];
}
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
  </script>
</head>
<body>
<div data-role="page" class="jqm-demos ui-responsive-panel" data-theme="<?php echo $theme; ?>" id="page1" data-title="Index Kartable">

<div data-role="header" data-theme="<?php echo $theme; ?>">
		<h1 style="font-size: 20px;">Historique de paiement pour <span style="text-transform: uppercase;"> <?php echo $object; ?></span></span></h1>
		<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" rel="external" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext">Back</a>
    
    </div><!-- /header -->

  <div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->

  <a href="./kartable_print_pdf.php?action=print_personnal_payement" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-action" style="width: 80px;">Imprimer</a>

<?php
$req=$db->prepare('SELECT*  FROM kartable_remuneration LEFT JOIN kartable_personnel
ON kartable_remuneration.id_personnel = kartable_personnel.id_personel WHERE kartable_remuneration.type_rem = :modalite
ORDER BY date_rem DESC');
$req->bindValue(':modalite', $object, PDO::PARAM_STR);
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
          </body>
    </html>