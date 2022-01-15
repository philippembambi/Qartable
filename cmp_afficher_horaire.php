<?php
require('kartable_debut.php');
$id_promo = (isset($_GET['id_promo']))?$_GET['id_promo']:0;

$promo=$db->prepare('SELECT*  FROM kartable_promotion 
WHERE kartable_promotion.id_promotion = :id_promo');
$promo->bindValue(':id_promo', $id_promo, PDO::PARAM_INT);
$promo->execute();
$data_promo = $promo->fetch();
$classe_promo = ($data_promo['classe_promo'] > 1 )?($data_promo['classe_promo']." ième"):($data_promo['classe_promo']." ière année");

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
		<h1 style="color: #3388cc;font-weight: bold;font-size: 17px;color: black;">Horaire de la <?php echo $classe_promo.' '.$data_promo['option_promo'] ?></h1>
		<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" rel="external" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-ajax="false">Back</a>
    <a href="#" onclick="window.location.reload();" rel="external" data-shadow="false" data-iconshadow="false" data-icon="recycle" data-iconpos="notext" data-ajax="false">Back</a>
  
    </div><!-- /header -->
    
  <div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->

<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-action" style="width: 80px;">Imprimer</a>

<?php
$horaire=$db->prepare('SELECT*  FROM kartable_horaire LEFT JOIN affectation_cours
ON kartable_horaire.id_affectation = affectation_cours.id_affectation LEFT JOIN kartable_cours 
ON affectation_cours.id_cours = kartable_cours.id_cours LEFT JOIN kartable_personnel
ON affectation_cours.id_enseignant = kartable_personnel.id_personel LEFT JOIN kartable_jours
ON kartable_horaire.id_jour = kartable_jours.id_jour LEFT JOIN heures
ON kartable_horaire.heure = heures.id_heure
WHERE kartable_horaire.id_promo = :id_promo AND kartable_horaire.id_jour = 1 ORDER BY kartable_horaire.heure ASC');
$horaire->bindValue(':id_promo', $id_promo, PDO::PARAM_INT);
$horaire->execute();

$lundi=$db->prepare('SELECT*  FROM kartable_horaire LEFT JOIN affectation_cours
ON kartable_horaire.id_affectation = affectation_cours.id_affectation LEFT JOIN kartable_cours 
ON affectation_cours.id_cours = kartable_cours.id_cours LEFT JOIN kartable_personnel
ON affectation_cours.id_enseignant = kartable_personnel.id_personel LEFT JOIN kartable_jours
ON kartable_horaire.id_jour = kartable_jours.id_jour LEFT JOIN heures
ON kartable_horaire.heure = heures.id_heure
WHERE kartable_horaire.id_promo = :id_promo AND kartable_horaire.id_jour = 1 ORDER BY kartable_horaire.heure ASC');
$lundi->bindValue(':id_promo', $id_promo, PDO::PARAM_INT);
$lundi->execute();

$mardi=$db->prepare('SELECT*  FROM kartable_horaire LEFT JOIN affectation_cours
ON kartable_horaire.id_affectation = affectation_cours.id_affectation LEFT JOIN kartable_cours 
ON affectation_cours.id_cours = kartable_cours.id_cours LEFT JOIN kartable_personnel
ON affectation_cours.id_enseignant = kartable_personnel.id_personel LEFT JOIN kartable_jours
ON kartable_horaire.id_jour = kartable_jours.id_jour LEFT JOIN heures
ON kartable_horaire.heure = heures.id_heure
WHERE kartable_horaire.id_promo = :id_promo AND kartable_horaire.id_jour = 2 ORDER BY kartable_horaire.heure ASC');
$mardi->bindValue(':id_promo', $id_promo, PDO::PARAM_INT);
$mardi->execute();

$mercredi=$db->prepare('SELECT*  FROM kartable_horaire LEFT JOIN affectation_cours
ON kartable_horaire.id_affectation = affectation_cours.id_affectation LEFT JOIN kartable_cours 
ON affectation_cours.id_cours = kartable_cours.id_cours LEFT JOIN kartable_personnel
ON affectation_cours.id_enseignant = kartable_personnel.id_personel LEFT JOIN kartable_jours
ON kartable_horaire.id_jour = kartable_jours.id_jour LEFT JOIN heures
ON kartable_horaire.heure = heures.id_heure
WHERE kartable_horaire.id_promo = :id_promo AND kartable_horaire.id_jour = 3 ORDER BY kartable_horaire.heure ASC');
$mercredi->bindValue(':id_promo', $id_promo, PDO::PARAM_INT);
$mercredi->execute();

$jeudi=$db->prepare('SELECT*  FROM kartable_horaire LEFT JOIN affectation_cours
ON kartable_horaire.id_affectation = affectation_cours.id_affectation LEFT JOIN kartable_cours 
ON affectation_cours.id_cours = kartable_cours.id_cours LEFT JOIN kartable_personnel
ON affectation_cours.id_enseignant = kartable_personnel.id_personel LEFT JOIN kartable_jours
ON kartable_horaire.id_jour = kartable_jours.id_jour LEFT JOIN heures
ON kartable_horaire.heure = heures.id_heure
WHERE kartable_horaire.id_promo = :id_promo AND kartable_horaire.id_jour = 4 ORDER BY kartable_horaire.heure ASC');
$jeudi->bindValue(':id_promo', $id_promo, PDO::PARAM_INT);
$jeudi->execute();

$vendredi=$db->prepare('SELECT*  FROM kartable_horaire LEFT JOIN affectation_cours
ON kartable_horaire.id_affectation = affectation_cours.id_affectation LEFT JOIN kartable_cours 
ON affectation_cours.id_cours = kartable_cours.id_cours LEFT JOIN kartable_personnel
ON affectation_cours.id_enseignant = kartable_personnel.id_personel LEFT JOIN kartable_jours
ON kartable_horaire.id_jour = kartable_jours.id_jour LEFT JOIN heures
ON kartable_horaire.heure = heures.id_heure
WHERE kartable_horaire.id_promo = :id_promo AND kartable_horaire.id_jour = 5 ORDER BY kartable_horaire.heure ASC');
$vendredi->bindValue(':id_promo', $id_promo, PDO::PARAM_INT);
$vendredi->execute();

$samedi=$db->prepare('SELECT*  FROM kartable_horaire LEFT JOIN affectation_cours
ON kartable_horaire.id_affectation = affectation_cours.id_affectation LEFT JOIN kartable_cours 
ON affectation_cours.id_cours = kartable_cours.id_cours LEFT JOIN kartable_personnel
ON affectation_cours.id_enseignant = kartable_personnel.id_personel LEFT JOIN kartable_jours
ON kartable_horaire.id_jour = kartable_jours.id_jour LEFT JOIN heures
ON kartable_horaire.heure = heures.id_heure
WHERE kartable_horaire.id_promo = :id_promo AND kartable_horaire.id_jour = 6 ORDER BY kartable_horaire.heure ASC');
$samedi->bindValue(':id_promo', $id_promo, PDO::PARAM_INT);
$samedi->execute();

echo $tab2_color; 

echo '<thead>
<tr>';

echo "<th data-priority='1'>Heure</th>
      <th>Lundi</th>
      <th>Mardi</th>
      <th>Mercredi</th>
      <th>Jeudi</th>
      <th>Vendredi</th>
      <th>Samedi</th>";
echo '</tr></thead><tbody>';

for($i = 0;$data_horaire = $horaire->fetch(), $data_lundi = $lundi->fetch(), $data_mardi = $mardi->fetch(), $data_mercredi = $mercredi->fetch(), $data_jeudi = $jeudi->fetch(), $data_vendredi = $vendredi->fetch(), $data_samedi = $samedi->fetch(); $i++ )
{

    echo '<tr>' . "\n";

    echo '<td style="font-weight: bold;">' . $data_horaire['intitule_heure'] . '</td>' . "\n"; 
    echo '<td><b style="color: #3388cc;font-weight: bold;">' . $data_lundi['intitule_cours'] . '</b><br> <span style="font-size: 15px;"> * '.$data_lundi['noms_personel'].'</span></td>' . "\n"; 
    echo '<td><b style="color: #3388cc;font-weight: bold;">' . $data_mardi['intitule_cours'] . '</b><br> <span style="font-size: 15px;"> * '.$data_mardi['noms_personel'].'</span></td>' . "\n"; 
    echo '<td><b style="color: #3388cc;font-weight: bold;">' . $data_mercredi['intitule_cours'] . '</b><br> <span style="font-size: 15px;"> * '.$data_mercredi['noms_personel'].'</span></td>' . "\n"; 
    echo '<td><b style="color: #3388cc;font-weight: bold;">' . $data_jeudi['intitule_cours'] . '</b><br> <span style="font-size: 15px;"> * '.$data_jeudi['noms_personel'].'</span></td>' . "\n"; 
    echo '<td><b style="color: #3388cc;font-weight: bold;">' . $data_vendredi['intitule_cours'] . '</b><br> <span style="font-size: 15px;"> * '.$data_vendredi['noms_personel'].'</span></td>' . "\n"; 
    echo '<td><b style="color: #3388cc;font-weight: bold;">' . $data_samedi['intitule_cours'] . '</b><br> <span style="font-size: 15px;"> * '.$data_samedi['noms_personel'].'</span></td>' . "\n"; 

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