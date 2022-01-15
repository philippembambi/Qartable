<?php
require_once "./PHPExcel/Classes/PHPExcel.php";

// Ouvrir un fichier Excel en lecture
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("MonPremierFichier.xlsx");
$sheet = $objPHPExcel->getActiveSheet();

// Premiere facon d'acceder au contenu de cellules du classeur Excel
$cell_1 = $sheet->getCell('A6') ;
$cell_2 = $sheet->getCell('A7') ;
$cell_3 = $sheet->getCell('A8') ;

echo 'Value : '.$cell_1->getValue()."\r\n" ;
echo 'Calculated Value : '.$cell_1->getCalculatedValue()."\r\n" ;
echo 'Formatted Value : '.$cell_1->getFormattedValue()."\r\n" ;
echo '<br>';
echo 'Value : '.$cell_2->getValue()."\r\n" ;
echo 'Calculated Value : '.$cell_2->getCalculatedValue()."\r\n" ;
echo 'Formatted Value : '.$cell_2->getFormattedValue()."\r\n" ;
echo '<br>';
echo 'Value : '.$cell_3->getValue()."\r\n" ;
echo 'Calculated Value : '.$cell_3->getCalculatedValue()."\r\n" ;
echo 'Formatted Value : '.$cell_3->getFormattedValue()."\r\n" ;
echo '<br>';
// Cas d'une cellule au format date
$cell = $sheet->getCell('B4');

//echo 'Date Value : '.$cell->getValue()."\r\n" ;
//echo 'Date Calculated Value : '.$cell->getCalculatedValue()."\r\n" ;
echo 'Date Formatted Value : '.$cell->getFormattedValue()."\r\n" ;
$timestamp = PHPExcel_Shared_Date::ExcelToPHP($cell->getValue()); // (Unix time)
$date = date('Y-m-d', $timestamp); // AAAA-MM-DD (formatted date)
echo '<br>';
echo $date."\r\n" ;
echo '<br>';

$startFrom = 1; //default value is 1
$limit = 10; //default value is null
foreach( $sheet->getRowIterator($startFrom, $limit) as $row ){
    foreach( $row->getCellIterator() as $cell ){
        $value = $cell->getCalculatedValue();
    }
}


$objWorksheet = $objPHPExcel->getActiveSheet();

$i = 0;
foreach ($objWorksheet->getRowIterator() as $row) {
    if ($i > 500) break;
    $i++;

    foreach ($row->getCellIterator() as $cell) {
        $cellValue = trim($cell->getCalculatedValue());
    }
}

?>

<!--Voici les deux façons de lire les données Excel-->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
      <link href="./managerCss/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
      <link rel="stylesheet" href="./addStyle.css">
<!--Js Jquery mobile-->
    <script src="jquery-2.1.1.min.js"></script>
    <script src="jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>

</head>

<body>
<?php
require_once "./PHPExcel/Classes/PHPExcel.php";

$instanceReader = new PHPExcel_Reader_Excel2007(); 
$objet = $instanceReader->load("kartable_eleve.xlsx");
$feuille = $objet->getActiveSheet();
$feuille->setCellValue('A12',"voici un nouvel exemple");
//$objet->save("kartable_eleve.xlsx");
// Ouvrir un fichier Excel en lecture
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("kartable_eleve.xlsx");
$sheet = $objPHPExcel->getActiveSheet();



echo '<table 
data-role="table" 
id="table-custom-2" 
data-mode="columntoggle" 
class="ui-body-d ui-shadow table-stripe ui-responsive" 
data-column-btn-theme="b" 
data-column-btn-text="Columns to display..." 
data-column-popup-theme="a">' . "\n"; 

echo '<thead>
<tr>
  <th data-priority="1">id</th>
  <th data-priority="2">Noms</th>
  <th data-priority="3">Sexe</th>
  <th data-priority="4">Date de naissance</th>
  <th data-priority="5">Lieu de naissance</th>
  <th data-priority="6">Classe</th>
  <th data-priority="7">Option</th>
  <th data-priority="8">A propos</th>
  <th data-priority="9">Photo</th>
  <th data-priority="10">Date d\'admission</th>
  <th data-priority="11">Id promo</th>
  <th data-priority="12">Id tuteur</th>
  <th data-priority="13">Id admin</th>
</tr>
</thead>';

echo '<tbody>';
foreach ($sheet->getRowIterator() as $row) 
{ 
    echo '<tr>' . "\n"; 
    $cellIterator = $row->getCellIterator();
     $cellIterator->setIterateOnlyExistingCells(true); 
     // This loops all cells, // even if it is not set. // By default, only cells 
     // that are set will be // iterated. 
     foreach ($cellIterator as $cell) 
     { 
         echo '<td>' . $cell->getValue() . '</td>' . "\n"; 
        } 
        echo '</tr>' . "\n";
        echo '</tbody>'; 
    } echo '</table>' . "\n";
?>


<?php
$highestRow = $sheet->getHighestRow(); // e.g. 10 
$highestColumn = $sheet->getHighestColumn(); // e.g 'F' 
$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5 

echo '<table 
data-role="table" 
id="table-custom-1" 
data-mode="columntoggle" 
class="ui-body-d ui-shadow table-stripe ui-responsive" 
data-column-btn-theme="b" 
data-column-btn-text="Columns to display..." 
data-column-popup-theme="a">' . "\n"; 

echo '<thead>
<tr>
  <th data-priority="1">Noms</th>
  <th data-priority="2">Sexe</th>
  <th data-priority="3">Date de naissance</th>
  <th data-priority="4">Lieu de naissance</th>
  <th data-priority="5">Classe</th>
  <th data-priority="6">Option</th>
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
    for ($col = 1; $col <= $highestColumnIndex; ++$col) 
    { 
        echo '<td>' . $sheet->getCellByColumnAndRow($col, $row)->getValue() . '</td>' . "\n"; 
    } 
    echo '</tr>' . "\n";
    echo '</tbody>'; 
} 
echo '</table>' . "\n";
?>

       </body>
 </html>