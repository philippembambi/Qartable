<?php
require('database.php');
include('kartable_debut.php');
?>
<?php
if(isset($_POST['filtre_date']))
{
    $date = $_POST['filtre_date'];
    $timestamp = strtotime($date);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
<!--Css Jquey mobile-->
    <link rel="stylesheet" href="jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
    <link rel="stylesheet" href="assets/css/jqm-demos.css">

    <link rel="stylesheet" href="./addStyle.css">

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

<div data-role="page" class="jqm-demos ui-responsive-panel" id="page1" data-title="Historique de pointage" data-url="" data-theme="<?php echo $theme; ?>">

<div data-role="header" data-theme="<?php echo $theme; ?>">
		<h1 style="font-size: 20px;">Pointage du <span style="color:#3388cc;"> <?php echo date('d/m/Y',$timestamp); ?></span></h1>
    <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" rel="external" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-ajax="false">Back</a>
  	<a href="#" onclick="window.location.reload();" rel="external" data-shadow="false" data-iconshadow="false" data-icon="recycle" data-iconpos="notext" data-ajax="false">Back</a>
  
   </div><!-- /header -->

<div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->

<form action="cmp_covert_date_personnel.php" method="post">  
  <label for="filtre_date" data-theme="a">Filtrer par date :</label>
  <input type="date" pattern="d/m/Y" name="filtre_date" id="filtre_date" value="" data-theme="a"/>
<button class="ui-input-btn ui-btn ui-corner-all ui-shadow" style="width: 100px;" rel="external">Filtrer</button>
</form>

<?php
$temps = date('d/m/Y',$timestamp);
$req=$db->prepare('SELECT*  FROM kartable_pointage LEFT JOIN kartable_personnel
ON kartable_pointage.id_personnel = kartable_personnel.id_personel 
WHERE kartable_pointage.date_pointage = :temps 
ORDER BY id_personnel ASC');
$req->bindValue(':temps', $temps, PDO::PARAM_STR);
$req->execute();

echo $tab2_color; 

echo '<thead style="color: #3388cc;">
<tr>';

echo "<th data-priority='1'>numéro</th>
      <th>Nom du personnel</th>
      <th>Fonction</th>
      <th>Pointé</th>
      <th>id admin</th>
      <th>Case à cocher</th>";
echo '</tr></thead><tbody>';

while ($data1 = $req->fetch())
{
    
    echo '<tr>' . "\n";  
    echo '<td style="font-weight: bold;">' . $data1['compteur'] . '</td>' . "\n"; 
    echo '<td style="font-weight: bold;">' . $data1['noms_personel'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['fonction'] . '</td>' . "\n";

    if($data1['pointe_present'] == 'Non')
    {
        echo '<td style="color:red;font-weight: bold;"> ' . $data1['pointe_present'] . '</td>' . "\n"; 
    }
    else{
        echo '<td style="color:green;font-weight: bold;"> ' . $data1['pointe_present'] . '</td>' . "\n"; 
    }
    echo '<td style="font-weight: bold;">' . $data1['id_admin_pointe'] . '</td>' . "\n";

    echo '<td>
    <a href="./kartable_moteur.php?action=pointerPersonnel&id_personel='.$data1['id_personel'].'&date_pointage='.$data1['date_pointage'].'" class="ui-input-btn ui-btn ui-btn-c ui-icon-check ui-btn-icon-left ui-shadow-icon" rel="external" disabled="">
   
    <label>
        <input type="checkbox" name="">Cocher
    </label>
    </a>
 </td>';

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