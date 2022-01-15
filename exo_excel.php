<?php
include 'php_excel_classes.php';
$workbook = new Phil_Excel();
$workbook->getActiveSheet()->getProtection()->setSheet(true);

$sheet = $workbook->getActiveSheet();

$sheet->setCellValue('A6',4);
$sheet->setCellValue('A7',5);
$sheet->setCellValue('A8','=A1*A2');
$sheet->setCellValue('A9','=enregistrement');
//Définir une font
$styleA1 = $sheet->getStyle('A1');
$styleFont = $styleA1->getFont()->applyFromArray(array(
'bold'=>true,
'size'=>15,
'name'=>Arial,
'color'=>array(
'rgb'=>'FF00FF00')));

$sheet->getStyle('B4')->getNumberFormat()->applyFromArray(
    array(
    'code' => 'dd/mm/yyyy'
    )
    );
    $sheet->setCellValue('B4', '=TODAY()');

//Ajouter une image
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('PHPExcel logo');
$objDrawing->setDescription('PHPExcel logo');
$objDrawing->setPath('./images/logo.png');
$objDrawing->setHeight(36);
$objDrawing->setCoordinates('D6');
$objDrawing->setOffsetX(-10);
$objDrawing->setWorksheet($sheet);

//style par défaut
$sheet->getDefaultStyle()->applyFromArray(array(
    'font'=>array(
    'name' => 'Arial',
    'size' => 12,
    'bold' => true),
    'alignment'=>array(
    'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER),
    'borders' => array(
    'allborders'=>array(
    'style' => PHPExcel_Style_Border::BORDER_DASHDOT))
    )
    );
//Dimension d'une cellule
//    $sheet->getColumnDimension('A')->setWidth(38);
  //  $sheet->getRowDimension('2')->setRowHeight(70);

$workbook->affiche('Excel2007','MonPremierFichier');
?>