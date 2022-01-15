<?php
require_once "./PHPExcel/Classes/PHPExcel.php";
require_once "./PHPExcel/Classes/PHPExcel/IOFactory.php";

$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("MonPremierFichier.xlsx");

$objPHPExcel->getActiveSheet()->setCellValue('D1', PHPExcel_Shared_Date::PHPToExcel(time()));
	$objPHPExcel->getActiveSheet()->setCellValue('D2', "juste un exemple");

//    $objPHPExcel->save("MonPremierFichier.xlsx");
?>