<?php
  //set it to writable location, a place for temp generated PNG files
  $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
  //html PNG location prefix
  $PNG_WEB_DIR = 'temp/';

include('phpqrcode\qrlib.php'); 

//ofcourse we need rights to create temp dir
if (!file_exists($PNG_TEMP_DIR))
mkdir($PNG_TEMP_DIR);


$filename = $PNG_TEMP_DIR.'test.png';

//processing form input
//remember to sanitize user input in real-life solution !!!
$errorCorrectionLevel = 'L';
if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
$errorCorrectionLevel = $_REQUEST['level'];    

$matrixPointSize = 4;
if (isset($_REQUEST['size']))
$matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);


if (isset($_REQUEST['data'])) { 

//it's very important!
if (trim($_REQUEST['data']) == '')
    die('data cannot be empty! <a href="?">back</a>');
    
// user data
$filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    

} else {    

//default data
echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';    
QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);    

}    


?>
<?php
          //config form
echo '<form action="template_QR_generator.php" method="post">
<label for="user">Donnée</label>
<input class="form-control" name="data" value="'.(isset($_REQUEST['data'])?htmlspecialchars($_REQUEST['data']):'PHP QR Code :)').'" />&nbsp;

<label for="sold">Taux de correction</label><br>
<select name="level" class="input-select" style="width:100%;" required autofocus>
    <option value="L"'.(($errorCorrectionLevel=='L')?' selected':'').'>L - smallest</option>
    <option value="M"'.(($errorCorrectionLevel=='M')?' selected':'').'>M</option>
    <option value="Q"'.(($errorCorrectionLevel=='Q')?' selected':'').'>Q</option>
    <option value="H"'.(($errorCorrectionLevel=='H')?' selected':'').'>H - best</option>
</select>

<label for="sold">Taille</label><br>
<select name="size" class="input-select" style="width:100%;" required autofocus>';

for($i=1;$i<=10;$i++)
echo '<option value="'.$i.'"'.(($matrixPointSize==$i)?' selected':'').'>'.$i.'</option>';

echo '</select>&nbsp;
<input type="submit" class="btn btn-lg btn-info btn-block" value="Génerer"></form><hr/>';
?>

<?php
          //display generated file
echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><hr/>';  

?>
