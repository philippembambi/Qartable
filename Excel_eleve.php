<?php
require('database.php');
/*
$date = str_replace('/', '_', "abcsd/hgdj/");
echo $date;

$today = (string) date('d/m/Y', time());
$date_today = str_replace('/', '_', $today);

$table = $db->prepare("CREATE TABLE IF NOT EXISTS $date_today(
  compteur INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  id_eleve INT(20) NOT NULL, 
  id_classe INT(20) NOT NULL, 
  date_pointage VARCHAR(20) NOT NULL, 
  pointe_present VARCHAR(20) NOT NULL, 
  id_admin INT(20) NOT NULL, 
  id_admin_pointe INT(20) NOT NULL
)");
$table->execute();
*/
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
<!--Css Jquey mobile-->
    <link rel="stylesheet" href="./jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
    <link rel="stylesheet" href="./assets/css/jqm-demos.css">
    <link rel="stylesheet" href="./css/theme_c.css">

<script src="./kartable_ajax.js"></script>
  
<!--Js Jquery mobile-->
    <script src="./jquery-2.1.1.min.js"></script>
    <script src="./jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>
  
  </head>

<body>

<?php
require_once "./PHPExcel/Classes/PHPExcel.php";

// Ouvrir un fichier Excel en lecture
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("kartable_eleve.xlsx");
$sheet = $objPHPExcel->getActiveSheet();

$highestRow = $sheet->getHighestRow(); // e.g. 10 
$highestColumn = $sheet->getHighestColumn(); // e.g 'F' 
$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5 

?>

<div data-role="page" class="jqm-demos ui-responsive-panel" id="page1" data-title="Feuille Excel élève" data-url="list_eleves" data-theme="c">


<div data-role="header" data-theme="a">
		<a href="./" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-rel="back" data-ajax="false">Back</a>
    </div><!-- /header -->
    <div role="main" class="ui-content" style="background-color:white;">
    <div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->

<ul data-role="listview" data-filter="true" data-filter-reveal="true" data-filter-placeholder="Rechercher dans Excel..." data-inset="true" data-theme="a">
<hr>
<?php
$date = str_replace('/', '_', "abcsd/hgdj/");
echo $date;

$jour_today = date('d', time());
$hier = (int) $jour_today - 1;

$date_hier =  $hier.'/'.date('m/Y', time());

echo $date_hier;

  for ($row = 2; $row <= $highestRow; ++$row) 
  { 
      for ($col = 1; $col <= 1; ++$col) 
      {
          ?>
    <li>
    <a href="#<?php echo substr($sheet->getCellByColumnAndRow($col, $row)->getValue(), 0, 5); ?>" data-rel="popup" data-position-to="window" class="ui-input-btn ui-btn ui-btn-c ui-icon-user ui-btn-icon-left ui-shadow-icon">
    <span style="color:black;">
    <?php echo $sheet->getCellByColumnAndRow($col, $row)->getValue(); ?>
    <label>
    <input type="checkbox" name="checkbox-0 ">Selectionner
    </label>
   
    </span>
    </a></li><p>
<?php 
}
}
?>
</ul>

<?php
  for ($row = 2; $row <= $highestRow; ++$row) 
  { 
      for ($col = 1; $col <= 1; ++$col) 
      {
          ?>
  <!-- Popups for lightbox images -->
  <div id="<?php echo substr($sheet->getCellByColumnAndRow($col, $row)->getValue(), 0, 5); ?>" data-role="popup" data-overlay-theme="b" style="background-color:white;">
      
  <?php echo'<img src="./images/'.$sheet->getCellByColumnAndRow(8, $row)->getValue().'" alt="Image" style="width:350px;height: 250px;"/>'; ?>
        <ul>
          <li>Noms :  <?php echo $sheet->getCellByColumnAndRow(1, $row)->getValue(); ?></li>
          <li>Sexe :  <?php echo $sheet->getCellByColumnAndRow(2, $row)->getValue(); ?></li>
          <li>Date de Naissance : <?php echo date('d/m/Y \à H:m',$sheet->getCellByColumnAndRow(3, $row)->getValue()); ?></li>
          <li>Lieu de naissance : <?php echo $sheet->getCellByColumnAndRow(4, $row)->getValue(); ?></li>
          <li>Classe : <?php echo (($sheet->getCellByColumnAndRow(5, $row)->getValue() > 1)?($sheet->getCellByColumnAndRow(5, $row)->getValue()." ième année"):($sheet->getCellByColumnAndRow(5, $row)->getValue()." ière année"))." ".$sheet->getCellByColumnAndRow(6, $row)->getValue(); ?></li>

          </ul>
  
<a href="./kartable_moteur.php?action=excelRegister&amp;id_eleve=<?php echo $sheet->getCellByColumnAndRow(0, $row)->getValue(); ?>" class="ui-btn ui-icon-check ui-btn-icon-left">Enregistrer</a>  
  </div>
  <?php 
}
}
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
<tr>
  <th>id</th>
  <th>Noms</th>
  <th>Sexe</th>
  <th data-priority="3">Date de naissance</th>
  <th data-priority="4">Lieu de naissance</th>
  <th data-priority="5">Classe</th>
  <th data-priority="3">Option</th>
  <th data-priority="7">A propos</th>
  <th data-priority="8">Photo</th>
  <th data-priority="9">Date d\'admission</th>
  <th data-priority="10">Id promo</th>
  <th data-priority="11">Id tuteur</th>
  <th data-priority="12">Id admin</th>
  
</tr>
</thead>';

echo '<tbody>';

for ($row = 2; $row <= $highestRow; ++$row) 
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
<script type="text/javascript" src="portojs/bootstrap.min.js"></script>
<script type="text/javascript" src="managerJs/jquery-2.1.1.min.js"></script>

 <script type="text/javascript">
    // Animations initialization
    new WOW().init();

  </script>

       </body>
 </html>