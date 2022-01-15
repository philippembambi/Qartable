<?php
require('./kartable_debut.php');

$id_promo = $_GET['id_promo'];

$query=$db->prepare('SELECT*  FROM kartable_promotion WHERE id_promotion = :id_promo');
$query->bindValue(':id_promo', $id_promo, PDO::PARAM_INT);
$query->execute();
$data = $query->fetch();
$classe_promo = ($data['classe_promo'] > 1 )?($data['classe_promo']." ième"):($data['classe_promo']." ière année");
$option_promo = $data['option_promo'];

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
<div data-role="page" class="jqm-demos ui-responsive-panel" data-theme="<?php echo $theme; ?>" id="page1" data-title="Emprunts">

<div data-role="header" data-theme="<?php echo $theme; ?>">
<h1 style="color: black;">Cours dispensés en <span style="color: #3388cc;"> <?php echo $classe_promo.'  '.$option_promo; ?></span></h1>
		<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" rel="external" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-ajax="false">Back</a>
		<a href="#" onclick="window.location.reload();" rel="external" data-shadow="false" data-iconshadow="false" data-icon="recycle" data-iconpos="notext" data-ajax="false">Back</a>
  </div><!-- /header -->

  <div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->
<br>

<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-search" style="width: 80px;">Zoomer</a>

<?php
$req=$db->prepare('SELECT * FROM kartable_cours LEFT JOIN affectation_cours
ON kartable_cours.id_cours = affectation_cours.id_cours LEFT JOIN kartable_personnel
ON affectation_cours.id_enseignant = kartable_personnel.id_personel LEFT JOIN kartable_horaire
ON kartable_horaire.id_affectation = affectation_cours.id_affectation
WHERE kartable_horaire.id_promo = :id_promo GROUP BY kartable_cours.id_cours ASC');
$req->bindValue(':id_promo', $id_promo, PDO::PARAM_INT);
$req->execute();

echo $tab2_color; 

echo '<thead style="color: #3388cc;">
<tr>';

echo "<th data-priority='1'>Id</th>
      <th>Intitulé du cours</th>
      <th>Pondération</th>
      <th>Enseignant</th>
      <th>Action</th>";
echo '</tr></thead><tbody>';

while ($data1 = $req->fetch())
{
    echo '<tr>' . "\n";  
    echo '<td style="font-weight: bold;">' . $data1['id_cours'] . '</td>' . "\n"; 
    echo '<td style="font-weight: bold;">' . $data1['intitule_cours'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;">0</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['noms_personel'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;"> <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-plus" style="width: 80px;"  rel="external" data-ajax="false">Détails</a>
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
          </body>
    </html>