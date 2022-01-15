<?php
require('database.php');
$id_promo = (isset($_GET['id_promo']))?$_GET['id_promo']:0;

$query=$db->prepare('SELECT*  FROM kartable_horaire LEFT JOIN kartable_promotion 
ON kartable_horaire.id_promo = kartable_promotion.id_promotion LEFT JOIN kartable_cours
ON kartable_horaire.id_cours = kartable_cours.id_cours
WHERE kartable_promotion.id_promotion = :id_promo');
$query->bindValue(':id_promo', $id_promo, PDO::PARAM_INT);
$query->execute();
$data = $query->fetch();
$classe_promo = ($data['classe_promo'] > 1 )?($data['classe_promo']." ième"):($data['classe_promo']." ière année");
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
<div data-role="header" data-theme="a">
		<h1>Horaire de la <?php echo $classe_promo; ?></h1>
		<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" rel="external" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-rel="back" data-ajax="false">Back</a>
	</div><!-- /header -->


  <div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->

 <?php
require_once "./PHPExcel/Classes/PHPExcel.php";
// Ouvrir un fichier Excel en lecture
$objReader = PHPExcel_IOFactory::createReader('Excel2007');

if($id_promo == 1)
{
  $objPHPExcel = $objReader->load("./HORAIRE/SECONDAIRE/horaire.xlsx");
  $sheet = $objPHPExcel->setActiveSheetIndex(0);  
}
elseif($id_promo == 2)
{
  $objPHPExcel = $objReader->load("./HORAIRE/SECONDAIRE/horaire.xlsx");
  $sheet = $objPHPExcel->setActiveSheetIndex(1);
}

elseif($id_promo == 3)
{
  $objPHPExcel = $objReader->load("./HORAIRE/LATIN-PHILO/horaire.xlsx");
  $sheet = $objPHPExcel->setActiveSheetIndex(0);
}

elseif($id_promo == 4)
{
  $objPHPExcel = $objReader->load("./HORAIRE/LATIN-PHILO/horaire.xlsx");
  $sheet = $objPHPExcel->setActiveSheetIndex(1);
}

elseif($id_promo == 5)
{
  $objPHPExcel = $objReader->load("./HORAIRE/LATIN-PHILO/horaire.xlsx");
  $sheet = $objPHPExcel->setActiveSheetIndex(2);
}

elseif($id_promo == 6)
{
  $objPHPExcel = $objReader->load("./HORAIRE/LATIN-PHILO/horaire.xlsx");
  $sheet = $objPHPExcel->setActiveSheetIndex(3);
}

elseif($id_promo == 7)
{
  $objPHPExcel = $objReader->load("./HORAIRE/BIOLOGIE-CHIMIE/horaire.xlsx");
  $sheet = $objPHPExcel->setActiveSheetIndex(0);
}

elseif($id_promo == 8)
{
  $objPHPExcel = $objReader->load("./HORAIRE/BIOLOGIE-CHIMIE/horaire.xlsx");
  $sheet = $objPHPExcel->setActiveSheetIndex(1);
}

elseif($id_promo == 9)
{
  $objPHPExcel = $objReader->load("./HORAIRE/BIOLOGIE-CHIMIE/horaire.xlsx");
  $sheet = $objPHPExcel->setActiveSheetIndex(2);
}

elseif($id_promo == 10)
{
  $objPHPExcel = $objReader->load("./HORAIRE/BIOLOGIE-CHIMIE/horaire.xlsx");
  $sheet = $objPHPExcel->setActiveSheetIndex(3);
}

elseif($id_promo == 11)
{
  $objPHPExcel = $objReader->load("./HORAIRE/COMMERCIALE-INFORMATIQUE/horaire.xlsx");
  $sheet = $objPHPExcel->setActiveSheetIndex(0);
}

if(!isset($sheet))
{
 ?>
 <h3 class="ui-bar ui-bar-a ui-corner-all"> <span style="color: red;">Erreur 30XE</span>  :: Fichier inéxistant</h3>
      <div class="ui-body ui-body-a ui-corner-all">
      
          <p style="font-size: 19px;">
          <img src="./images/Error_color100px.png" alt="" style="height: 30px;">
        Le chargement de l'horaire a été intérrompu... <br><br> Voici les problèmes aux quels cette erreur peut résulter :
        <ul>
          <li>Absence du fichier de l'horaire sur le serveur</li>
          <li>Erreur de connexion au serveur ou de chargement de la page</li>
          <li>Fichier de l'horaire corrompu</li>
        </ul>
        <img src="./images/loader.gif" alt="" style="float: right;margin-top: -10%;">
        </p>
      </div>

<?php
die;
}
$highestRow = $sheet->getHighestRow(); // e.g. 10 
$highestColumn = $sheet->getHighestColumn(); // e.g 'F' 
$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5 
?>

<?php

echo '<table 
data-role="table" 
id="table-custom-1" 
data-mode="columntoggle" 
class="ui-body-d ui-shadow table-stripe ui-responsive" 
data-column-btn-theme="a" 
data-column-btn-text="Affichage..." 
data-column-popup-theme="a">' . "\n"; 

echo '<thead>
<tr>';

for ($row = 2; $row <= 2; ++$row) 
{
for ($col = 0; $col <= $highestColumnIndex; ++$col) 
{
echo "<th data-priority=".$col.">". $sheet->getCellByColumnAndRow($col, $row)->getValue() .'</th>';
}}
echo '</tr></thead><tbody>';

for ($row = 3; $row <= $highestRow; ++$row) 
{ 
    echo '<tr>' . "\n"; 
    for ($col = 0; $col <= $highestColumnIndex; ++$col) 
    { 
        echo '<td>' . $sheet->getCellByColumnAndRow($col, $row)->getValue() . '</td>' . "\n"; 
    } 
    echo '</tr>' . "\n";
    echo '</tbody>'; 
} 
echo '</table>' . "\n";
?>
</div>

          </div>
          </div>
          </body>
    </html>