<?php 
require('../database.php');
include("../kartable_debut.php");

$id_eleve = (isset($_GET["id_eleve"]))?htmlspecialchars($_GET["id_eleve"]):0;
$id_frais = (isset($_GET["id_frais"]))?htmlspecialchars($_GET["id_frais"]):0;
$message = (isset($_GET["message"]))?htmlspecialchars($_GET["message"]):"";

$info_frais = $db->prepare('SELECT * FROM kartable_frais_scolaire LEFT JOIN kartable_eleves
ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve
LEFT JOIN kartable_promotion ON kartable_eleves.promotion_id = kartable_promotion.id_promotion
WHERE id_frais = :id_frais AND kartable_eleves.id_eleve = :id_eleve');
$info_frais->bindValue(':id_frais', $id_frais, PDO::PARAM_INT);
$info_frais->bindValue(':id_eleve', $id_eleve, PDO::PARAM_INT);
$info_frais->execute();
$data_frais = $info_frais->fetch(); 

$classe_promo = ($data_frais['classe_promo'] > 1 )?($data_frais['classe_promo']." ième"):($data_frais['classe_promo']." ière année");
$option_promo = $data_frais['option_promo'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    
    <?php require('header_file.html');  ?>

   <script>
$.mobile.document.on( "pagebeforeshow", function(){
  make_sleep();
});

function PrintDiv() {

                  var divToPrint = document.getElementById('divToPrint');
                  var popupWin = window.open('', '_blank', 'width=1500,height=1500');
                  popupWin.document.open();
                  popupWin.document.write('<html><head><link rel="stylesheet" href="../css/bootstrap.css"></head><body onload="window.print()">' +
                    divToPrint.innerHTML + '</html>');
                  popupWin.document.close();
                }
              </script>
</head>
<style>
  .col-sm-4 {
  position: relative;
  min-height: 1px;
  padding-right: 15px;
  padding-left: 15px;
}
  .panel {
  margin-bottom: 20px;
  background-color: #fff;
  border: 1px solid transparent;
  -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
}
.panel-body {
  padding: 15px;
}
.panel-heading {
  padding: 10px 15px;
  border-bottom: 1px solid transparent;
  border-top-left-radius: 3px;
  border-top-right-radius: 3px;
}
.panel-title {
  margin-top: 0;
  margin-bottom: 0;
  font-size: 16px;
  color: inherit;
}
.panel-default {
  border-color: #ddd;
}
.panel-default > .panel-heading {
  color: #333333;
  background-color: #c7caca;
  border-color: #c7caca;
}
.panel-default > .panel-heading + .panel-collapse > .panel-body {
  border-top-color: #ddd;
}
.panel-default > .panel-heading .badge {
  color: #f5f5f5;
  background-color: #333333;
}
.panel-default > .panel-footer + .panel-collapse > .panel-body {
  border-bottom-color: #ddd;
}

</style>
<body>
  
<div data-role="page" class="jqm-demos ui-responsive-panel" id="page1" data-title="Reçu de paiement" data-url="Reçu" data-theme="d">

<div data-role="header" data-theme="c">

<?php
if($message != "")
{
?>
<link rel="stylesheet" href="../css/font-awesome.css">

<div data-role="header" data-theme="a">
<h1 style="color: white;">Verouillage du réçu de paiement</h1>
		<a href="#" rel="external" data-shadow="false" data-iconshadow="false" data-icon="lock" data-iconpos="notext" data-ajax="false">Back</a>
	</div><!-- /header -->
<br>
<div class="alert alert-success" role="alert" style="margin-left: 4%;margin-right: 4%;margin-top: 2%;">
       <h3> <strong><?php echo $message; ?></strong></h3>
      </div>
<?php 
die;
} ?>

<div class="ui-body-b ui-body">
    <h3 style="color: green;">Paiement de l'élève <strong style="color: black;"><?php echo $data_frais['noms_eleve']; ?></strong> a été effectué avec succès !</h3>
    <div data-role="navbar">
        <ul>
            <li><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="ui-btn-a" rel="back" data-ajax="false" data-icon="back">Retour</a></li>
            <li><a href="#" onclick="PrintDiv();" class="ui-btn-a" data-icon="action">Imprimer le reçu</a></li>
          <!--  <li><a href="./kartable_print_pdf.php?action=print_recu&amp;id_eleve=<?php// echo $id_eleve; ?>&id_frais=<?php// echo $id_frais;?>" class="ui-btn-a" data-icon="action">Imprimer le reçu</a></li> -->
            
            <li><a href="#confirmation" data-rel="popup" data-position-to="window" class="ui-btn-a" data-icon="alert">Signaler une erreur</a></li>
        </ul>
    </div><!-- /navbar -->
</div><!-- /container -->
</div><!-- /header -->


<div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->

<p>

</p>

<div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title"><span style="font-size: 18px;font-family: leelawadee;font-weight: bold;" contenteditable="">Reçu N° <u><strong style="font-size: 20px;letter-spacing: 1px;"><?php echo $data_frais['id_frais']; ?></strong> </u></span>
            <span style="text-align: center;margin-left: 25%;font-size: 17px;font-weight: bold;">Année scolaire <?php echo $data_frais['annee_scolaire']; ?> </span>
                 <span style="float: right;"><i style="font-size: 16px;font-family: leelawadee;">Montant en chiffre</i>  <br>
                <div style="margin-top: 1%; border: 1px solid transparent;background-color: white;height: 30px;width: 200px;" contenteditable="">
           <strong style="font-size: 22px;"><?php echo $data_frais['montant'].' '.$data_frais['devise']; ?></strong> 
            </div>
             </span>
                </h2>
                <br>
          </div>
          <div class="panel-body">
              
            <span style="font-size: 20px;font-family: leelawadee;font-weight: bold;" contenteditable="">. Noms  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;<b style="font-size: 22px;letter-spacing: 2px;"><?php echo $data_frais['noms_eleve']; ?></b></span>
         <br>
            <span style="font-size: 20px;font-family: leelawadee;font-weight: bold;" contenteditable="">. Sexe  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size: 22px;letter-spacing: 2px;"><?php echo $data_frais['sexe_eleve']; ?></b></span>
            <br>
            <span style="font-size: 20px;font-family: leelawadee;font-weight: bold;" contenteditable="">. Classe &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size: 22px;letter-spacing: 2px;"><?php echo $classe_promo.' '.$option_promo; ?></b></span>
         <span style="float: right;margin-top: -5%;"><img src="./img/image_qrcode.png" alt=""></span>
         <p></p><br>

            <span style="font-size: 19px;font-family: leelawadee;font-weight: bold;"> La somme de : <i>(en toute lettre et manuellement)</i> <br>
                <div style="margin-top: 2%; border: 1px solid transparent;  color: #333333;
                background-color: #c7caca;
                border-color: #ddd;height: 50px;width: 100%;" contenteditable="">&nbsp;</div>    
            </span>
<p></p>
<span style="font-size: 20px;font-family: leelawadee;font-weight: bold;" contenteditable=""> Motif : 
<u style="font-size: 22px;letter-spacing: 2px;">
<?php
if($data_frais['motif'] == "fraisScolaire")
{
  echo "Frais scolaires";  
}
else{
  echo "Autre frais";
}
 ?>
</u></span>
     <hr>
<div>
    <br>
    <span style="font-size: 16px;font-family: leelawadee;font-weight: bold;"> Signature du (de la) caissier (è)</span>

    <span style="font-size: 16px;font-family: leelawadee;font-weight: bold;float: right;" contenteditable=""> Fait à kinshasa, <strong style="font-size: 18px;"><?php echo $data_frais['date_paiement']; ?></strong></span>
    <p></p><br>

</div>
        </div>
        </div>
     
      </div><!-- /.col-sm-4 -->

      <div data-role="popup" id="confirmation" data-overlay-theme="b" data-dismissible="false" style="max-width:400px;">

<div role="main" class="ui-content" style="background-color:white;">
    <h2 class="ui-title" style="color: black;font-size: 18px;">&Eacute;tes-vous sûr de vouloir verouiller ce reçu ?</h2>
<hr>
    <a href="#" class="ui-btn ui-corner-all ui-btn-inline ui-btn-c ui-btn-icon-left ui-icon-delete" data-rel="back" style="color: black;">Annuler</a>
    
    <a href="./kartable_moteur.php?action=signaler_erreur&amp;id_recu=<?php echo $id_frais; ?>&amp;id_eleve=<?php echo $id_eleve; ?>" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b ui-btn-icon-left ui-icon-check" id="confirm" rel="external">Confirmer</a>
</div>
</div>

</div>
</div>


<div data-role="page" id="divToPrint">

      <div class="col-sm-4" style="font-size: 13px;">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h2 class="panel-title">
              <img src="./img/bordure_kartable.jpg" alt="" style="margin-top: -1%; border: 1px solid transparent;  color: #333333;
                  border-color: #ddd;height: 50px;width: 100%;"> 
                  <span style="position: absolute; z-index: 2;left: 5%;top: 3%;">
          
                  <span style="font-family: leelawadee;" contenteditable="">Reçu N° <u style="font-weight: bolder;"><?php echo $data_frais['id_frais']; ?></u>
                        
              
            </span>
           
               </span>

               <span style="float: right;position: absolute; z-index: 2;right: 6%;top: 3%;"><i style="font-family: leelawadee;">Montant en chiffre</i>  <br>
<div style="border: 1px solid transparent;background-color: white;height: 30px;width: 100px;font-weight: bolder;" contenteditable="">
            <?php echo $data_frais['montant'].' '.$data_frais['devise']; ?>
</div>
               </span>

                  </h2>
                  <br>
            </div>

            <span style="margin-left: 30%;font-weight: bold;">Lycée MAMA DIANKEBA / B.P : 1900 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
            <?php echo $data_frais['annee_scolaire']; ?>
          
             </span>

            <div class="panel-body" style="border-top-color: #ddd;">
                
              <span style="font-family: leelawadee;font-weight: bold;" contenteditable="">. Noms  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;<b style="letter-spacing: 2px;"><?php echo $data_frais['noms_eleve']; ?></b></span>
           <br>
              <span style="font-family: leelawadee;font-weight: bold;" contenteditable="">. Sexe  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp;<b style="letter-spacing: 2px;"><?php echo $data_frais['sexe_eleve']; ?></b></span>
              <br>
              <span style="font-family: leelawadee;font-weight: bold;" contenteditable="">. Classe &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp;<b style="letter-spacing: 2px;"><?php echo $classe_promo.' '.$option_promo; ?></b></span>
      
           <p></p><br>
  
              <span style="font-family: leelawadee;font-weight: bold;"> La somme de : <i>(en toute lettre et manuellement)</i> <br>
            <img src="./img/bordure_kartable.jpg" alt="" style="margin-top: 2%; border: 1px solid transparent;  color: #333333;
                  border-color: #ddd;height: 50px;width: 100%;"> 
            </span>
  <p></p>
  <span style="font-family: leelawadee;font-weight: bold;" contenteditable=""> Motif : 
  <u style="letter-spacing: 2px;">
  <?php
  if($data_frais['motif'] == "fraisScolaire")
  {
    echo "Frais scolaires";  
  }
  else{
    echo "Autre frais";
  }
   ?>
  </u></span>
<br>
  <span style="font-family: leelawadee;font-weight: bold;" contenteditable=""> Modalité : 
<?php echo $data_frais['modalite']; ?>
  </span>

       <hr>
  <div>

      <span style="font-family: leelawadee;font-weight: bold;"> Signature du (de la) caissier (è)</span>
  
      <span style="font-family: leelawadee;font-weight: bold;float: right;" contenteditable=""> Fait à kinshasa, <?php echo $data_frais['date_paiement']; ?></span>
          </div>
          </div>
        </div><!-- /.col-sm-4 -->
  
  </div>
  </div>

</body>
</html>