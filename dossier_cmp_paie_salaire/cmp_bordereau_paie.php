<?php 
require('../database.php');
include("../kartable_debut.php");

$id_personel = (isset($_GET["id_personel"]))?htmlspecialchars($_GET["id_personel"]):0;
$id_rem = (isset($_GET["id_rem"]))?htmlspecialchars($_GET["id_rem"]):0;
$message = (isset($_GET["message"]))?htmlspecialchars($_GET["message"]):"";

$info_paie = $db->prepare('SELECT * FROM kartable_remuneration LEFT JOIN kartable_personnel
ON kartable_remuneration.id_personnel = kartable_personnel.id_personel 
WHERE kartable_remuneration.id_rem = :id_rem AND kartable_personnel.id_personel = :id_personel');
$info_paie->bindValue(':id_rem', $id_rem, PDO::PARAM_INT);
$info_paie->bindValue(':id_personel', $id_personel, PDO::PARAM_INT);
$info_paie->execute();
$data_paie = $info_paie->fetch(); 

if($data_paie['devise_rem'] == "usd")
    {
        $exchange_rate = "$";
    }
    elseif($data_paie['devise_rem'] == "fc")
    {
        $exchange_rate = "FC";
    }
    else{
        $exchange_rate = "Francs";
    }

$nbre_absence=$db->prepare('SELECT COUNT(*) AS nbre_absence FROM kartable_pointage LEFT JOIN kartable_personnel
ON kartable_pointage.id_personnel = kartable_personnel.id_personel 
WHERE kartable_personnel.id_personel = :idPerso AND kartable_pointage.pointe_present = :valeurPointage');
$nbre_absence->bindValue(':idPerso', $id_personel, PDO::PARAM_INT);
$nbre_absence->bindValue(':valeurPointage', 'Non', PDO::PARAM_STR);
$nbre_absence->execute();
$nbre_total = $nbre_absence->fetch();

$nbre_classes=$db->prepare('SELECT COUNT(*) AS nbre_classes FROM kartable_personnel LEFT JOIN affectation_cours
ON kartable_personnel.id_personel = affectation_cours.id_enseignant LEFT JOIN kartable_horaire
ON affectation_cours.id_affectation = kartable_horaire.id_affectation 
WHERE affectation_cours.id_enseignant = :idPerso');
$nbre_classes->bindValue(':idPerso', $id_personel, PDO::PARAM_INT);
$nbre_classes->execute();
$total_classes = $nbre_classes->fetch();

$mois = date('m', time());

$nbre_heure=$db->prepare('SELECT SUM(nbre_heure) AS nbre_total_heure FROM kartable_pointage 
LEFT JOIN kartable_personnel
ON kartable_pointage.id_personnel = kartable_personnel.id_personel 
WHERE kartable_personnel.id_personel = :idPerso AND kartable_pointage.mois = MONTH("2020/11/23") ');
$nbre_heure->bindValue(':idPerso', $id_personel, PDO::PARAM_INT);
//$nbre_heure->bindValue(':mois', $mois, PDO::PARAM_INT);
$nbre_heure->execute();
$total_heure = $nbre_heure->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <?php require('header_files.html'); ?>
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
  
<div data-role="page" class="jqm-demos ui-responsive-panel" id="page1" data-title="Bordereau de paiement" data-url="Bordereau" data-theme="d">

<div data-role="header" data-theme="c">

<?php
if($message != "")
{
?>
<link rel="stylesheet" href="./css/font-awesome.css">

<div data-role="header" data-theme="a">
<h1 style="color: white;">Verouillage du bordereau de paiement</h1>
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
    <h3 style="color: green;">Bordereau de paie du personnel  <strong style="color: black;"><?php echo $data_paie['noms_personel']; ?></strong> a été effectuée avec succès !</h3>
    <div data-role="navbar">
        <ul>
            <li><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="ui-btn-a" rel="back" data-ajax="false" data-icon="back">Retour</a></li>
            <li><a href="#" onclick="PrintDiv();" class="ui-btn-a" data-icon="action">Imprimer le bordereau</a></li>
          <!--  <li><a href="./kartable_print_pdf.php?action=print_recu&amp;id_personel=<?php// echo $id_personel; ?>&id_rem=<?php// echo $id_rem;?>" class="ui-btn-a" data-icon="action">Imprimer le Bordereau</a></li> -->
            
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
            <h2 class="panel-title"><span style="font-size: 18px;font-family: leelawadee;font-weight: bold;" contenteditable="">Bordereau N° <u><strong style="font-size: 20px;letter-spacing: 1px;"><?php echo $data_paie['id_rem']; ?></strong> </u></span>
             <span style="float: right;"><i style="font-size: 16px;font-family: leelawadee;">Montant en chiffre</i>  <br>
                <div style="margin-top: 1%; border: 1px solid transparent;background-color: white;height: 30px;width: 200px;" contenteditable="">
           <strong style="font-size: 22px;"><?php echo $data_paie['montant_rem'].' '.$exchange_rate; ?></strong> 
            </div>
             </span>
                </h2>
                <br>
          </div>
          <div class="panel-body">
              
            <span style="font-size: 20px;font-family: leelawadee;font-weight: bold;" contenteditable="">. Noms  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;<b style="font-size: 22px;letter-spacing: 2px;"><?php echo $data_paie['noms_personel']; ?></b></span>
         <br>
            <span style="font-size: 20px;font-family: leelawadee;font-weight: bold;" contenteditable="">. Sexe  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size: 22px;letter-spacing: 2px;"><?php echo $data_paie['sexe']; ?></b></span>
            <br>
            <span style="font-size: 20px;font-family: leelawadee;font-weight: bold;" contenteditable="">. Fonction &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size: 22px;letter-spacing: 2px;"><?php echo $data_paie['fonction']; ?></b></span>
         <span style="float: right;margin-top: -5%;"><img src="../img/image_qrcode.png" alt=""></span>
         <p></p><br>

         Observation
       <hr>
<span style="font-size: 20px;font-family: leelawadee;font-weight: bold;" contenteditable=""> 

<ul>
    <li>Pour le mois de : <?php echo $data_paie['mois_rem']; ?></li>
    <li>Nombre d'absence : <?php echo $nbre_total['nbre_absence']; ?></li>
    <li>Nombre d'heure effectuée : <?php echo $total_heure['nbre_total_heure']; ?></li>
    <li>Nombre de cours dispensés : <?php echo $total_classes['nbre_classes']; ?></li>
</ul>
</span>

     <hr>
<div>
    <br>
    <span style="font-size: 16px;font-family: leelawadee;font-weight: bold;"> Signature du (de la) caissier (è)</span>

    <span style="font-size: 16px;font-family: leelawadee;font-weight: bold;float: right;" contenteditable=""> Fait à kinshasa, <strong style="font-size: 18px;"><?php echo $data_paie['date_rem']; ?></strong></span>
    <p></p><br>

</div>
        </div>
        </div>
     
      </div><!-- /.col-sm-4 -->

      <div data-role="popup" id="confirmation" data-overlay-theme="b" data-dismissible="false" style="max-width:400px;">

<div role="main" class="ui-content" style="background-color:white;">
    <h2 class="ui-title" style="color: black;font-size: 18px;">&Eacute;tes-vous sûr de vouloir verouiller ce Bordereau ?</h2>
<hr>
    <a href="#" class="ui-btn ui-corner-all ui-btn-inline ui-btn-c ui-btn-icon-left ui-icon-delete" data-rel="back" style="color: black;">Annuler</a>
    
    <a href="./kartable_moteur.php?action=signaler_erreur_bordereau.php&amp;id_bordereau=<?php echo $id_rem; ?>&amp;id_personel=<?php echo $id_personel; ?>" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b ui-btn-icon-left ui-icon-check" id="confirm" rel="external">Confirmer</a>
</div>
</div>

</div>
</div>


<div data-role="page" id="divToPrint">

      <div class="col-sm-4" style="font-size: 13px;">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h2 class="panel-title">
              <img src="../img/bordure_kartable.jpg" alt="" style="margin-top: -1%; border: 1px solid transparent;  color: #333333;
                  border-color: #ddd;height: 50px;width: 100%;"> 
                  <span style="position: absolute; z-index: 2;left: 5%;top: 3%;">
          
                  <span style="font-family: leelawadee;" contenteditable="">Bordereau N° <u style="font-weight: bolder;"><?php echo $data_paie['id_rem']; ?></u>
                        
              
            </span>
           
               </span>

               <span style="float: right;position: absolute; z-index: 2;right: 6%;top: 3%;"><i style="font-family: leelawadee;">Montant en chiffre</i>  <br>
<div style="border: 1px solid transparent;background-color: white;height: 30px;width: 100px;font-weight: bolder;" contenteditable="">
<?php echo $data_paie['montant_rem'].' '.$exchange_rate; ?>
</div>
               </span>

                  </h2>
            </div>

            <span style="margin-left: 30%;font-weight: bold;">Lycée MAMA DIANKEBA / B.P : 1900 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
             </span>
<br>
            <div class="panel-body" style="border-top-color: #ddd;">
                
              <span style="font-family: leelawadee;font-weight: bold;" contenteditable="">. Noms  :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;<b style="letter-spacing: 2px;"><?php echo $data_paie['noms_personel']; ?></b></span>
           <br>
              <span style="font-family: leelawadee;font-weight: bold;" contenteditable="">. Sexe  :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp;<b style="letter-spacing: 2px;"><?php echo $data_paie['sexe']; ?></b></span>
              <br>
              <span style="font-family: leelawadee;font-weight: bold;" contenteditable="">. Fonction  :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp;<b style="letter-spacing: 2px;"><?php echo $data_paie['fonction']; ?></b></span>
      
           <p></p>
  Observation
  <hr style="border-color: black;">
  <span style="font-family: leelawadee;font-weight: bold;" contenteditable="">
    <ul>
    <li>Pour le mois de : <?php echo $data_paie['mois_rem']; ?></li>
    <li>Nombre d'absence : <?php echo $nbre_total['nbre_absence']; ?></li>
</ul>

<ul style="float: right;margin-top: -8%;">
    <li>Nombre d'heure effectuée : <?php echo $total_heure['nbre_total_heure']; ?></li>
    <li>Nombre de cours dispensés : <?php echo $total_classes['nbre_classes']; ?></li>
</ul>
</span>
   <hr style="border-color: black;">
  <div>
<br>
      <span style="font-family: leelawadee;font-weight: bold;font-size: 11px;"> Signature du (de la) caissier (è) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      Signature du personnel</span>
      <span style="font-family: leelawadee;font-weight: bold;float: right;font-size: 11px;" contenteditable=""> Fait à kinshasa, <?php echo $data_paie['date_rem']; ?></span>
          </div>
          </div>
        </div><!-- /.col-sm-4 -->
  
  </div>
  </div>

</body>
</html>