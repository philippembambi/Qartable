<?php
require_once "./PHPExcel/Classes/PHPExcel.php";
$instanceReader = new PHPExcel_Reader_Excel2007(); 
$objet = $instanceReader->load("bulletin.xlsm");
$feuille = $objet->getActiveSheet();
header('location: bulletin.xlsm');
?>