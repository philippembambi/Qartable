<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebCam</title>
    <link rel="stylesheet" href="./jqueryUi/jquery-ui.css">
    <script src="./jquery-2.1.1.min.js"></script>
    <script src="./jqueryUi/jquery-ui.js"></script>
    <style>
        video {
          border: 3px solid #ccc;
          background: green;
          width: 400px;
          height: 400px;
         }
    </style>
</head>

<body>
<input type="file" name="" id="file">
<progress id="barre"></progress>

<div style="letter-spacing: 2px;line-height: 30px;"><marquee behavior="" direction="">Philippe</marquee>
  
Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio commodi aspernatur ullam recusandae, rem minima cupiditate vero veniam. Reprehenderit doloremque et eum ea voluptates quisquam iste deleniti impedit, saepe nulla!
</div>
<script>
  var inputElement = $('#file');
  
inputElement.change(function(){
var files = inputElement.attr('files');
var file = files[0];
var xhr = new XMLHttpRequest();
$('#barre').progressbar({ value: 0 }); // on initialise le plugin
xhr.open('POST', 'upload.php');

xhr.onprogress = function(e){
var loaded = Math.round((e.loaded / e.total) * 100); // on calcul le pourcentage de progression
$('#barre').progressbar('value', loaded);
}
xhr.onload = function(){
$('#barre').progressbar('value', 100);
}
var form = new FormData();
form.append('file', inputElement.file);
xhr.send(form);
});
</script>
  <input type="button" onclick="capture()" value="Compatibilité">

<button>Start camera</button>
               <br/>
               <video></video>
     
               <script>
                    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                         console.log("getUserMedia() not supported.");
                    }
     
                    var btn = document.querySelector('button');
                   
                    btn.onclick=function(e) {
     
    navigator.mediaDevices.getUserMedia({ audio: true, video: true, image: true })
                             .then(function(stream) {
                                 var video = document.querySelector('video');
                                 if ("srcObject" in video) {
                                     video.srcObject = stream;
                                 } else {
                                     video.src = window.URL.createObjectURL(stream);
                                 }
                                 video.onloadedmetadata = function(e) {
                                     video.play();
                                 };
                            })
                              .catch(function(err) {
                                   console.log(err.name + ": " + err.message);
                               });
     
                    };
                    
               </script> 
    

    <script>
  function capture()
{  
// check for mediaDevices.enumerateDevices() support
if (!navigator.mediaDevices || !navigator.mediaDevices.enumerateDevices) {
  console.log("enumerateDevices() not supported.");
  return;
}
else { 
navigator.mediaDevices.enumerateDevices()
.then(function(devices) {
  devices.forEach(function(device) {
    console.log(device.kind + ": " + device.label + " id = " + device.deviceId);
  });
})
.catch(function(err) {
  console.log(err.name + ": " + err.message);
});
}

}
    </script>
</body>
</html>


include 'php_excel_classes.php';
$workbook = new Phil_Excel();
$sheet = $workbook->getActiveSheet();
$sheet->setCellValue('A1','MaitrePylos');

$workbook->affiche('Excel2007','MonPremierFichier');


<?php 
public function register_fromExcel($row)
{
require("./PHPExcel/Classes/PHPExcel.php");
// Ouvrir le fichier Excel d'inscription en lecture
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("kartable_eleve.xlsx");
$sheet = $objPHPExcel->getActiveSheet();

    $q = $this->_db->prepare('INSERT INTO kartable_eleves (noms_eleve, sexe_eleve, lieu_naissance, date_naissance, classe_eleve, option_eleve, info_supplementaire, photo_eleve, date_inscription, admin_id, promotion_id, id_tuteur) 
    VALUES(:e_noms, :e_sexe, :e_lieu, :e_date_naiss, :e_classe, :e_option, :e_info, :e_photo, :date_inscription, :e_id_admin, :e_promo, :id_tuteur)');
    $q->bindValue(':e_noms', $sheet->getCellByColumnAndRow(1, $row)->getValue(), PDO::PARAM_STR);
       $q->bindValue(':e_sexe', $sheet->getCellByColumnAndRow(2, $row)->getValue(), PDO::PARAM_STR);
          $q->bindValue(':e_lieu', $sheet->getCellByColumnAndRow(3, $row)->getValue(), PDO::PARAM_STR);
             $q->bindValue(':e_date_naiss', $sheet->getCellByColumnAndRow(4, $row)->getValue(), PDO::PARAM_STR);
                $q->bindValue(':e_classe', $sheet->getCellByColumnAndRow(5, $row)->getValue(), PDO::PARAM_INT);
                   $q->bindValue(':e_option', $sheet->getCellByColumnAndRow(6, $row)->getValue(), PDO::PARAM_STR);
                      $q->bindValue(':e_info', $sheet->getCellByColumnAndRow(7, $row)->getValue(), PDO::PARAM_STR);
                         $q->bindValue(':e_photo', $sheet->getCellByColumnAndRow(8, $row)->getValue(), PDO::PARAM_STR);
                            $q->bindValue(':date_inscription', $sheet->getCellByColumnAndRow(9, $row)->getValue(), PDO::PARAM_STR);
                               $q->bindValue(':e_id_admin', $sheet->getCellByColumnAndRow(10, $row)->getValue(), PDO::PARAM_INT);
                                  $q->bindValue(':e_promo', $sheet->getCellByColumnAndRow(11, $row)->getValue(), PDO::PARAM_INT);
                                     $q->bindValue(':id_tuteur', $sheet->getCellByColumnAndRow(12, $row)->getValue(), PDO::PARAM_INT);
                                        $q->execute();
                                           $q->CloseCursor();
header("location:".$_SERVER['HTTP_REFERER']);    
}


?>

<script>
        function storageAvailable(type) {
    var storage;
    try {
        storage = window[type];
        var x = '__storage_test__';
        storage.setItem(x, x);
        storage.removeItem(x);
        return true;
    }
    catch(e) {
        return e instanceof DOMException && (
            // everything except Firefox
            e.code === 22 ||
            // Firefox
            e.code === 1014 ||
            // test name field too, because code might not be present
            // everything except Firefox
            e.name === 'QuotaExceededError' ||
            // Firefox
            e.name === 'NS_ERROR_DOM_QUOTA_REACHED') &&
            // acknowledge QuotaExceededError only if there's something already stored
            (storage && storage.length !== 0);
    }
}
    </script>


<?php
case "excelRegister":
$row = $_GET['id_eleve'];
require("./PHPExcel/Classes/PHPExcel.php");
// Ouvrir le fichier Excel d'inscription en lecture
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("kartable_eleve.xlsx");
$sheet = $objPHPExcel->getActiveSheet();
    $e_noms = $sheet->getCellByColumnAndRow(1, $row)->getValue();
    $e_sexe = $sheet->getCellByColumnAndRow(2, $row)->getValue();
    $e_date_naiss = $sheet->getCellByColumnAndRow(3, $row)->getValue();
          $e_lieu = $sheet->getCellByColumnAndRow(4, $row)->getValue();
          $e_classe = $sheet->getCellByColumnAndRow(5, $row)->getValue();
          $e_option = $sheet->getCellByColumnAndRow(6, $row)->getValue();
          $e_info = $sheet->getCellByColumnAndRow(7, $row)->getValue();
          $e_image = $sheet->getCellByColumnAndRow(8, $row)->getValue();
          $date_isncription = $sheet->getCellByColumnAndRow(9, $row)->getValue();
                      $id_admin = $sheet->getCellByColumnAndRow(10, $row)->getValue();
                      $e_promo = $sheet->getCellByColumnAndRow(11, $row)->getValue();
                      $id_tuteur = $sheet->getCellByColumnAndRow(12, $row)->getValue();
                      $e_promo = 0;
                      if($e_classe == 1 && $e_option == "secondaire")
                      {
                          $e_promo = 1;
                      }
                      else if($e_classe == 2 && $e_option == "secondaire")
                      {
                          $e_promo = 2;
                      }
                      //La troisième année
                      else if($e_classe == 3 && $e_option == "latinphilo")
                      {
                          $e_promo = 3;
                      }
                      else if($e_classe == 3 && $e_option == "biochimie")
                      {
                          $e_promo = 7;
                      }
                      else if($e_classe == 3 && $e_option == "commerciale")
                      {
                          $e_promo = 11;
                      }
                      //La quatrième année
                      else if($e_classe == 4 && $e_option == "latinphilo")
                      {
                          $e_promo = 4;
                      }
                      else if($e_classe == 4 && $e_option == "biochimie")
                      {
                          $e_promo = 8;
                      }
                      else if($e_classe == 4 && $e_option == "commerciale")
                      {
                          $e_promo = 12;
                      }
                      //La cinquième année
                      else if($e_classe == 5 && $e_option == "latinphilo")
                      {
                          $e_promo = 5;
                      }
                      else if($e_classe == 5 && $e_option == "biochimie")
                      {
                          $e_promo = 9;
                      }
                      else if($e_classe == 5 && $e_option == "commerciale")
                      {
                          $e_promo = 13;
                      }
                      //La sixième année
                      else if($e_classe == 6 && $e_option == "latinphilo")
                      {
                          $e_promo = 6;
                      }
                      else if($e_classe == 6 && $e_option == "biochimie")
                      {
                          $e_promo = 10;
                      }
                      else if($e_classe == 6 && $e_option == "commerciale")
                      {
                          $e_promo = 14;
                      }
                      else 
                      {
                          $e_promo = 0;
                      }
                   
$pupil_excel = new eleve($db);
$pupil_excel->register_fromExcel($e_noms, $e_sexe, $e_lieu, $e_date_naiss, $e_classe, $e_option, $e_info, $e_image, $id_admin, $e_promo, $id_tuteur, $date_isncription);
break;  
?>

<?php

$sql = "CREATE TABLE IF NOT EXISTS '$nom_table'(
    compteur INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    id_eleve INT(20) NOT NULL, 
    id_classe INT(20) NOT NULL, 
    date_pointage VARCHAR(20) NOT NULL, 
    pointe_present VARCHAR(20) NOT NULL, 
    id_admin INT(20) NOT NULL, 
    id_admin_pointe INT(20) NOT NULL
)";
$db->exec($sql);

?>


<?php
$today = (string) date('d/m/Y', time());
$date_today = str_replace('/', '_', $today);

$table = $db->prepare("CREATE TABLE IF NOT EXISTS $date_today(
  compteur INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  id_eleve INT(20) NOT NULL, 
  id_promo INT(20) NOT NULL, 
  date_pointage VARCHAR(20) NOT NULL, 
  pointe_present VARCHAR(20) NOT NULL, 
  id_admin INT(20) NOT NULL, 
  id_admin_pointe INT(20) NOT NULL
)");
$table->execute();

$query=$db->prepare('SELECT*  FROM kartable_eleves');
$query->execute();
while ($data = $query->fetch())
{
    $q = $db->prepare("INSERT INTO $date_today (id_eleve, id_promo, date_pointage, pointe_present, id_admin) 
    VALUES(:id_eleve, :id_promo, :date_pointage, :pointe_present, :id_admin)");
        $q->bindValue(':id_eleve', $data['id_eleve'], PDO::PARAM_INT);
           $q->bindValue(':id_promo', (int) $id_promo, PDO::PARAM_INT);
              $q->bindValue(':date_pointage', $today, PDO::PARAM_STR);
                 $q->bindValue(':pointe_present', 'Non', PDO::PARAM_STR);
                    $q->bindValue(':id_admin', $id_admin, PDO::PARAM_INT);
                       $q->execute();
                          $q->CloseCursor();
}
?>


<?php
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
?>


class graphe_third_dim
    {
       protected int i;
       protected int degre_inter_a = 0, degre_exter_a = 0, degre_a = 0;
       protected int degre_inter_b = 0, degre_exter_b = 0, degre_b = 0;
       protected int degre_inter_c = 0, degre_exter_c = 0, degre_c = 0;
       protected string orientation_a, orientation_b, orientation_c;

        public graphe_third_dim()
        {

        }
         
        public void build_graphe_third_dim()
        { 
            Console.WriteLine("On conidère le graphe G(U, X) de Trois sommets à savoir : a, b, et c");
            Console.WriteLine("\n");
            Console.WriteLine("Le sommet __a__ est orienté vers : ");
            this.orientation_a = Console.ReadLine();
            switch (this.orientation_a)
            {
                case "b":
                    this.degre_exter_a++;
                    this.degre_inter_b++;
                    break;
                case "c":
                    this.degre_exter_a++;
                    this.degre_inter_c++;
                    break;
                default:
                    Console.WriteLine("Entrer un sommet valide : ");
                    this.build_graphe_third_dim();
                    break;
            }

            Console.WriteLine("Le sommet __b__ est orienté vers : ");
            this.orientation_b = Console.ReadLine();
            switch (this.orientation_b)
            {
                case "a":
                    this.degre_exter_b++;
                    this.degre_inter_a++;
                    break;
                case "c":
                    this.degre_exter_b++;
                    this.degre_inter_c++;
                    break;
                default:
                    Console.WriteLine("Entrer un sommet valide : ");
                    this.build_graphe_third_dim();
                    break;
            }

            Console.WriteLine("Le sommet __c__ est orienté vers : ");
            this.orientation_c = Console.ReadLine();
            switch (this.orientation_c)
            {
                case "a":
                    this.degre_exter_c++;
                    this.degre_inter_a++;
                    break;
                case "b":
                    this.degre_exter_c++;
                    this.degre_inter_b++;
                    break;
                default:
                    Console.WriteLine("Entrer un sommet valide : ");
                    this.build_graphe_third_dim();
                    break;
            }
            Console.WriteLine("_______ Sommet a _______: ");
            Console.WriteLine("* dégré exterieur vaut : " + this.degre_exter_a.ToString());
            Console.WriteLine("* dégré interieur vaut : " + this.degre_inter_a.ToString());
            this.degre_a = this.degre_exter_a + this.degre_inter_a;
            Console.WriteLine("* dégré vaut : " + this.degre_a.ToString());
            Console.WriteLine("\n");

            Console.WriteLine("_______ Sommet b _______: ");
            Console.WriteLine("* dégré exterieur vaut : " + this.degre_exter_b.ToString());
            Console.WriteLine("* dégré interieur vaut : " + this.degre_inter_b.ToString());
            this.degre_b = this.degre_exter_b + this.degre_inter_b;
            Console.WriteLine("* dégré vaut : " + this.degre_b.ToString());
            Console.WriteLine("\n");

            Console.WriteLine("_______ Sommet c _______: ");
            Console.WriteLine("* dégré exterieur vaut : " + this.degre_exter_c.ToString());
            Console.WriteLine("* dégré interieur vaut : " + this.degre_inter_c.ToString());
            this.degre_c = this.degre_exter_c + this.degre_inter_c;
            Console.WriteLine("* dégré vaut : " + this.degre_c.ToString());
        }
    }