<?php
require_once "./PHPExcel/Classes/PHPExcel.php";

// Ouvrir un fichier Excel en lecture
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("./BD_ECOLE/BD_ECOLE.xlsx");
$sheet = $objPHPExcel->setActiveSheetIndex(0);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('./BD_ECOLE/BD_ECOLE.xlsx');

require_once "./PHPExcel/Classes/PHPExcel.php";

// Ouvrir un fichier Excel en lecture
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("./BD_ECOLE/BD_ECOLE.xlsx");
$sheet = $objPHPExcel->setActiveSheetIndex(0);

$highestRow = $sheet->getHighestRow(); // e.g. 10 
$highestColumn = $sheet->getHighestColumn(); // e.g 'F' 
$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5 

require('database.php');
$query=$db->prepare('SELECT*  FROM kartable_eleves');
$query->execute();

for ($row = 3; $row <= $highestRow, $data = $query->fetch(); ++$row) 
{
  $sheet->setCellValueByColumnAndRow(0, $row, $data['id_eleve']);   
}

$query1=$db->prepare('SELECT*  FROM kartable_eleves');
$query1->execute();

for ($row = 3; $row <= $highestRow, $data1 = $query1->fetch(); ++$row) 
{
  $sheet->setCellValueByColumnAndRow(1, $row, $data1['noms_eleve']);   
}

$query2=$db->prepare('SELECT*  FROM kartable_eleves');
$query2->execute();

for ($row = 3; $row <= $highestRow, $data2 = $query2->fetch(); ++$row) 
{
  $sheet->setCellValueByColumnAndRow(2, $row, $data2['sexe_eleve']);   
}

$query3=$db->prepare('SELECT*  FROM kartable_eleves');
$query3->execute();

for ($row = 3; $row <= $highestRow, $data3 = $query3->fetch(); ++$row) 
{
  $sheet->setCellValueByColumnAndRow(3, $row, $data3['date_naissance']);   
}

$query4=$db->prepare('SELECT*  FROM kartable_eleves');
$query4->execute();

for ($row = 3; $row <= $highestRow, $data4 = $query4->fetch(); ++$row) 
{
  $sheet->setCellValueByColumnAndRow(4, $row, $data4['lieu_naissance']);   
}

$query5=$db->prepare('SELECT*  FROM kartable_eleves');
$query5->execute();

for ($row = 3; $row <= $highestRow, $data5 = $query5->fetch(); ++$row) 
{
  $sheet->setCellValueByColumnAndRow(5, $row, $data5['classe_eleve']);   
}

$query6=$db->prepare('SELECT*  FROM kartable_eleves');
$query6->execute();

for ($row = 3; $row <= $highestRow, $data6 = $query6->fetch(); ++$row) 
{
  $sheet->setCellValueByColumnAndRow(6, $row, $data6['option_eleve']);   
}

$query7=$db->prepare('SELECT*  FROM kartable_eleves');
$query7->execute();

for ($row = 3; $row <= $highestRow, $data7 = $query7->fetch(); ++$row) 
{
  $sheet->setCellValueByColumnAndRow(7, $row, $data7['info_supplementaire']);   
}

$query8=$db->prepare('SELECT*  FROM kartable_eleves');
$query8->execute();

for ($row = 3; $row <= $highestRow, $data8 = $query8->fetch(); ++$row) 
{
  $sheet->setCellValueByColumnAndRow(8, $row, $data8['photo_eleve']);   
}

$query9=$db->prepare('SELECT*  FROM kartable_eleves');
$query9->execute();

for ($row = 3; $row <= $highestRow, $data9 = $query9->fetch(); ++$row) 
{
  $sheet->setCellValueByColumnAndRow(9, $row, $data9['date_inscription']);   
}

$query10=$db->prepare('SELECT*  FROM kartable_eleves');
$query10->execute();

for ($row = 3; $row <= $highestRow, $data10 = $query10->fetch(); ++$row) 
{
  $sheet->setCellValueByColumnAndRow(10, $row, $data10['admin_id']);   
}

$query11=$db->prepare('SELECT*  FROM kartable_eleves');
$query11->execute();

for ($row = 3; $row <= $highestRow, $data11 = $query11->fetch(); ++$row) 
{
  $sheet->setCellValueByColumnAndRow(11, $row, $data11['promotion_id']);   
}

$query12=$db->prepare('SELECT*  FROM kartable_eleves');
$query12->execute();

for ($row = 3; $row <= $highestRow, $data12 = $query12->fetch(); ++$row) 
{
  $sheet->setCellValueByColumnAndRow(12, $row, $data12['id_tuteur']);   
}
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('./BD_ECOLE/BD_ECOLE.xlsx');

?>