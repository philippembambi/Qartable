<?php
require('database.php');
include('kartable_debut.php');
$jour_today = date('d', time());
$hier = (int) $jour_today - 1;
$date_hier =  $hier.'/'.date('m/Y', time());
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

<div data-role="page" class="jqm-demos ui-responsive-panel" data-theme="<?php echo $theme; ?>" id="page1" data-title="Index Kartable">

<div data-role="header" data-theme="<?php echo $theme; ?>">
		<h1 style="font-size: 20px;">Pointage du <span style="color:#3388cc;"> <?php echo $date_hier;
 ?></span></h1>
		<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" rel="external" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-ajax="false">Back</a>
  	<a href="#" onclick="window.location.reload();" rel="external" data-shadow="false" data-iconshadow="false" data-icon="recycle" data-iconpos="notext" data-ajax="false">Back</a>
     
    </div><!-- /header -->


  <div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->
  
  <form action="cmp_covert_date_personnel.php" method="post" rel="external">  
  <label for="filtre_date" data-theme="a">Filtrer par date :</label>
  <input type="date" pattern="d/m/Y" name="filtre_date" id="filtre_date" value="" data-theme="a"/>
<button class="ui-input-btn ui-btn ui-corner-all ui-shadow" style="width: 100px;" rel="external">Filtrer</button>
</form>

<?php
$req=$db->prepare('SELECT*  FROM kartable_pointage LEFT JOIN kartable_personnel
ON kartable_pointage.id_personnel = kartable_personnel.id_personel 
WHERE kartable_pointage.date_pointage = :today 
ORDER BY id_personnel ASC');
$req->bindValue(':today', $date_hier, PDO::PARAM_STR);
$req->execute();

echo $tab1_color; 

echo '<thead style="color: #3388cc;">
<tr>';

echo "<th data-priority='1'>id</th>
      <th data-priority='2'>Nom du personnel</th>
      <th data-priority='3'>Fonction</th>
      <th data-priority='4'>Pointé</th>
      <th data-priority='5'>id admin</th>
      <th>Nombre d'heures</th>
      <th>Finaliser l'action</th>";
echo '</tr></thead><tbody>';

while ($data1 = $req->fetch())
{
    
    echo '<tr>' . "\n";  
    echo '<td style="font-weight: bold;">' . $data1['id_personnel'] . '</td>' . "\n"; 
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

    echo '<td style="font-weight: bold;">
    <form action="kartable_moteur.php?action=marquer_nbre_heure_personnel&amp;id_personel='.$data1['id_personel'].'&amp;date_pointage='.$data1['date_pointage'].'" method="post">
    <input type="number" name="nbre_heure" id="nbre_heure" value="'.$data1['nbre_heure'].'"/>
    <input type="submit" value="Valider" rel="external" data-ajax="false">
    </form>
    </td>' . "\n";

    echo '<td>
    <a href="./kartable_moteur.php?action=pointerPersonnel&id_personel='.$data1['id_personel'].'&date_pointage='.$data1['date_pointage'].'" class="ui-input-btn ui-btn ui-btn-c ui-icon-check ui-btn-icon-left ui-shadow-icon" rel="external">
   
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