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

<?php
$id_promo = (isset($_GET['id_promo']))?$_GET['id_promo']:0;

if(isset($_POST['filtre_date']))
{
    $date = $_POST['filtre_date'];
    $timestamp = strtotime($date);
    echo date('d/m/Y',$timestamp);
}
?>

<div data-role="page" class="jqm-demos ui-responsive-panel" id="page1" data-title="eleve" data-url="list_eleves" data-theme="<?php echo $theme; ?>">

<div data-role="header" data-theme="<?php echo $theme; ?>">
		<h1 style="font-size: 20px;">Registre d'appel du <span style="color:#3388cc;"> <?php echo date('d/m/Y',$timestamp); ?></span></h1>
		<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" rel="external" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-ajax="false">Back</a>
    <a href="#" onclick="window.location.reload();" rel="external" data-shadow="false" data-iconshadow="false" data-icon="recycle" data-iconpos="notext" data-ajax="false">Back</a>
  
    </div><!-- /header -->

<div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->

<form action="cmp_convert_date_eleve.php?id_promo=<?php echo $id_promo;?>" method="post">
  <label for="filtre_date" data-theme="a">Filtrer par date :</label>
  <input type="date" pattern="d/m/Y" name="filtre_date" id="filtre_date" value="" data-theme="a"/>
  <button class="ui-input-btn ui-btn ui-corner-all ui-shadow" style="width: 100px;" rel="external">Filtrer</button>
</form>

<?php
$date = date('d/m/Y', $timestamp);
$req=$db->prepare('SELECT*  FROM kartable_registre_appel LEFT JOIN kartable_eleves
ON kartable_registre_appel.id_eleve = kartable_eleves.id_eleve 
WHERE kartable_registre_appel.date_pointage = :filter_day AND kartable_eleves.promotion_id = :promotion_id');
$req->bindValue(':filter_day', $date, PDO::PARAM_STR);
$req->bindValue(':promotion_id', $id_promo, PDO::PARAM_INT);
$req->execute();

echo $tab1_color; 

echo '<thead style="color: #3388cc;">
<tr>';

echo "<th data-priority='1'>numéro</th>
      <th>Nom de l'élève</th>
      <th>Sexe</th>
      <th>Pointé</th>
      <th>id admin</th>
      <th>Pointer</th>";
echo '</tr></thead><tbody>';

while ($data1 = $req->fetch())
{
    
    echo '<tr>' . "\n";  
    echo '<td style="font-weight: bold;">' . $data1['compteur'] . '</td>' . "\n"; 
    echo '<td style="font-weight: bold;">' . $data1['noms_eleve'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['sexe_eleve'] . '</td>' . "\n";

    if($data1['pointe_present'] == 'Non')
    {
        echo '<td style="color:red;font-weight: bold;"> ' . $data1['pointe_present'] . '</td>' . "\n"; 
    }
    else{
        echo '<td style="color:green;font-weight: bold;"> ' . $data1['pointe_present'] . '</td>' . "\n"; 
    }
    echo '<td style="font-weight: bold;">' . $data1['id_admin_pointe'] . '</td>' . "\n";

    echo '<td>
    <a href="./kartable_moteur.php?action=pointerElevel&id_eleve='.$data1['id_eleve'].'&date_pointage='.$data1['date_pointage'].'" class="ui-input-btn ui-btn ui-btn-c ui-icon-check ui-btn-icon-left ui-shadow-icon" rel="external">
   
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