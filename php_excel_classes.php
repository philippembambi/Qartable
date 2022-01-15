<?php
/**
* Classe étendue de PHPExcel.
* Cette classe permet la génération dynamique
* de fichier tableur suivant différent format.
*/
require_once "./PHPExcel/Classes/PHPExcel.php";

class Phil_Excel extends PHPExcel 
{

public function __construct() 
{
parent::__construct();
}
/**
* Méthode englobant une fonction switch pour le choix du format de tableur.
* @method affiche
* @param String $format
* @param String $nomFichier
* @example $workbook->affiche('Excel2007','MonFichier');
*/
public function affiche($format = 'Excel5',$nomFichier = 'Tableur')
{

switch($format)
{
case 'Excel2007' :

include "./PHPExcel/Classes/PHPExcel/Writer/Excel2007.php";
$writer = new PHPExcel_Writer_Excel2007($this);
$ext = 'xlsx';
$header = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
//supprime le pré-calcul
$writer->setPreCalculateFormulas(true);
break;

case 'Excel2003' :
include "./PHPExcel/Classes/PHPExcel/Writer/Excel2007.php";
$writer = new PHPExcel_Writer_Excel2007($this);
$writer->setOffice2003Compatibility(true);
$ext = 'xlsx';
$header = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
//supprime le pré-calcul
$writer->setPreCalculateFormulas(true);
break;

case 'Excel5' :
require "./PHPExcel/Classes/PHPExcel.php";
$writer = new PHPExcel_Writer_Excel5($this);
$ext = 'xls';
$header = 'application/vnd.ms-excel';
break;

case 'CSV' :
include "./PHPExcel/Classes/PHPExcel/Writer/CSV.php";
$writer = new PHPExcel_Writer_CSV($this);
$writer->setDelimiter(",");//l'opérateur de séparation est la virgule
$writer->setSheetIndex(0);//Une seule feuille possible
$ext = 'csv';
$header = 'text/csv';
break;

case 'PDF' :
include './PHPExcel/Classes/PHPExcel/Writer/PDF.php';
$writer = new PHPExcel_Writer_PDF($this);
$writer->setSheetIndex(0);//Une seule feuille possible
$ext = 'pdf';
$header = 'application/pdf';
break;

case 'HTML' :
include './PHPExcel/Classes/PHPExcel/Writer/HTML.php';
$writer = new PHPExcel_Writer_HTML($this);
$writer->setSheetIndex(0);//Une seule feuille possible
$ext = 'html';
$header = 'text/html';
break;
}
$records = './'.$nomFichier.'.'.$ext;
$writer->save($records);
header('location: '.$records);
}
/**
* Méthode englobant une fonction switch pour le choix du format de tableur.
* @method enregistre
* @param String $format
* @param String $nomFichier
* @example $workbook->enregistre('Excel2007','MonFichier');
*/
public function enregistre($format = 'Excel5',$nomFichier = 'Tableur')
{
switch($format)
{
case 'Excel2007' :
include './PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';
$writer = new PHPExcel_Writer_Excel2007($this);
$ext = 'xlsx';
//supprime le pré-calcul
$writer->setPreCalculateFormulas(true);
break;

case 'Excel2003' :
include './PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';
$writer = new PHPExcel_Writer_Excel2007($this);
$writer->setOffice2003Compatibility(true);
$ext = 'xlsx';
//supprime le pré-calcul
$writer->setPreCalculateFormulas(false);
break;

case 'Excel5' :
include './PHPExcel/Classes/PHPExcel/Writer/Excel5.php';
$writer = new PHPExcel_Writer_Excel5($this);
$ext = 'xls';
break;

case 'CSV' :
include "./PHPExcel/Classes/PHPExcel/Writer/CSV.php";
$writer = new PHPExcel_Writer_CSV($this);
$writer->setDelimiter(",");//l'opérateur de séparation est la virgule
$writer->setSheetIndex(0);//Une seule feuille possible
$ext = 'csv';
break;

case 'PDF' :
include './PHPExcel/Classes/PHPExcel/Writer/PDF.php';
$writer = new PHPExcel_Writer_PDF($this);
$writer->setSheetIndex(0);//Une seule feuille possible
$ext = 'pdf';
break;

case 'HTML' :
include './PHPExcel/Classes/PHPExcel/Writer/HTML.php';
$writer = new PHPExcel_Writer_HTML($this);
$writer->setSheetIndex(0);//Une seule feuille possible
$ext = 'html';
break;
}
$writer->save($nomFichier.'.'.$ext);
}
}

?>