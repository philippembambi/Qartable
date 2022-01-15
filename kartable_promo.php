<?php
require('database.php');
require('kartable_debut.php');

if($var_print_class == 'none')
{    
  if($var_root == 'none')
  {
  $msg = 'Accès réfusé !';
  header('location: ./dialog.php?msg='.$msg);
  }
}

$Maclasse =  (isset($_GET["Maclasse"]))?$_GET["Maclasse"]:0;
$Masection = (isset($_GET["Masection"]))?htmlspecialchars($_GET["Masection"]):'Aucune';

switch($Maclasse)
{
case $Maclasse == 7:
    $id_promo = 1;
break;

case $Maclasse == 8:
    $id_promo = 2;
break;
//La troisième année

case $Maclasse == 1 && $Masection == 'latinphilo' || $Masection == 'Latin Philo':
    $id_promo = 3;
break;

case $Maclasse == 1 && $Masection == 'biochimie' || $Masection == 'Chimie Biologie':
    $id_promo = 7;
break;

case $Maclasse == 1 && $Masection == 'commerciale' || $Masection == 'Commerciale Info':
    $id_promo = 11;
break;

//La quatrième année
case $Maclasse == 2 && $Masection == 'latinphilo' || $Masection == 'Latin Philo':
    $id_promo = 4;
break;

case $Maclasse == 2 && $Masection == 'biochimie' || $Masection == 'Chimie Biologie':
    $id_promo = 8;
break;

case $Maclasse == 2 && $Masection == 'commerciale' || $Masection == 'Commerciale Info':
    $id_promo = 12;
break;
//La cinquième année

case $Maclasse == 3 && $Masection == 'latinphilo' || $Masection == 'Latin Philo':
    $id_promo = 5;
break;

case $Maclasse == 3 && $Masection == 'biochimie' || $Masection == 'Chimie Biologie':
    $id_promo = 9;
break;

case $Maclasse == 3 && $Masection == 'commerciale' || $Masection == 'Commerciale Info':
    $id_promo = 13;
break;

//La sixième année

case $Maclasse == 4 && $Masection == 'latinphilo' || $Masection == 'Latin Philo':
    $id_promo = 6;
break;

case $Maclasse == 4 && $Masection == 'biochimie' || $Masection == 'Chimie Biologie':
    $id_promo = 10;
break;

case $Maclasse == 4 && $Masection == 'commerciale' || $Masection == 'Commerciale Info':
    $id_promo = 14;
break;
}
 if($id_promo != 0)
  {
  $query=$db->prepare('SELECT*  FROM kartable_promotion WHERE id_promotion = :id_promo');
  $query->bindValue(':id_promo', $id_promo, PDO::PARAM_INT);
  $query->execute();
  $data = $query->fetch();
  $classe_promo = ($data['classe_promo'] > 1 )?($data['classe_promo']." ième"):($data['classe_promo']." ière");
  $option_promo = $data['option_promo'];
  }
  else{
  break;
  }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="shortcut icon" type="image/png" href="./images/Graduation.png">
<!--Css Jquey mobile-->
    <link rel="stylesheet" href="./jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
    <link rel="stylesheet" href="./assets/css/jqm-demos.css">
    <link rel="stylesheet" href="./font-awesome.css">
    <link rel="stylesheet" href="./css/font-awesome.css">
<!--Css importées-->
    <link rel="stylesheet" href="./portofolio/animate.css">
      <link href="./portofolio/prettyPhoto.css" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="./css/style.css"/>
      <link href="./managerCss/bootstrap.min.css" rel="stylesheet">
      <!-- Material Design Bootstrap -->
       <link href="./managerCss/mdb.css" rel="stylesheet">
     
      <link href="managerCss/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/addStyle.css">
    <link rel="stylesheet" href="./css/theme_classic.css">
   <!--Vue.js--> 
  <script src="./vue.js"> </script>
  <script src="./managerJs/myscripts.js"></script>
  <script src="./kartable_ajax.js"></script>
  
<!--Js Jquery mobile-->
    <script src="./jquery-2.1.1.min.js"></script>
    <script src="./jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script type="text/javascript">
$.mobile.document.on( "pagebeforeshow", function(){

  setTimeout(function(){
    document.getElementById("infoKartable").click();
             }, 2000);
             });

$(document).on('mobileinit', function(){
    $.mobile.defaultPageTransition = 'slide';
});

</script>

<style>
  .ui-btn-active {
    background-color: #3388cc;
    border-color: #3388cc;
}
li a:after {
  background-color: #3388cc;
    border-color: #3388cc;
}
</style>

</head>

<body onload="testerNavigateur()">

   <!--authentification admin-->
   <div class="modal fade" id="modalLoginAvatarDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
      <!--Content-->
      <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
          <img src="images/user.png" class="rounded-circle img-responsive"
            alt="Avatar photo">
        </div>
        <!--Body-->
        <div class="modal-body text-center mb-1">
 <h5 class="mt-1 mb-2">Administrateur</h5>
     <div class="md-form ml-0 mr-0">
            <label for="form1" class="ml-0">Mot de Passe...</label>
            <input type="password" type="text" id="motdepasse" name="motdepasse" class="form-control ml-0" required>            
          <span id="reponseAdmin"></span>
          </div>

          <div class="text-center mt-4">
            <button class="ui-btn ui-corner-all ui-icon-check ui-btn-icon-left ui-shadow ui-btn-inline ui-btn-b" onclick="connect_admin()"> Valider
            </button>
      </div>        </div>  </div>   <!--/.Content--> </div> </div>

      <?php
$user=$db->prepare('SELECT*  FROM kartable_admin WHERE id_admin = :id_admin');
$user->bindValue(':id_admin', $id_admin, PDO::PARAM_INT);
$user->execute();
$dataUser = $user->fetch();
?>


<!--1ière page-->
<div data-role="page" class="ui-responsive-panel" id="page1" data-title="<?php echo $classe_promo.' '.$option_promo ?>" data-theme="">

<app-menu2></app-menu2>
<?php include("./dossier_menu/menu_classe.php"); ?>
<?php include("./dossier_popup/template_popup2.php"); ?>

    <div data-role="header" style="overflow:hidden;" data-theme="c">

      <section class="hero-area-fix">
            <div class="hero-area" id="water">
<a href="#info" data-rel="popup" id="infoKartable">
            <span style="margin-left: 1%;"><img src="./images/logo.png" alt="" style="height: 60px;"></span>
</a>
            <div class="hero-text">
                        <div id="typed-strings">           
                          <h2 style="color: black;"><?php echo $classe_promo.' '.$option_promo; ?></h2>
                        </div> 
                        <h2><span id="typed"></span></h2>
                         </div> 
                         <a href="#" v-on:click="show = !show" class="ui-btn ui-icon-info ui-btn-icon-notext" style="float:right;margin-right: 2%;">Icon only</a>
                         </div>
                  </section>

                  <div data-role="navbar">
                    <div data-role="footer" class="nav-glyphish-example" data-theme="c">
                      <div data-role="navbar" class="nav-glyphish-example" data-grid="d">
                      <ul>
                          <li><a href="#left-panel" data-icon="grid">Menu</a></li> 
                          <li><a href="#" data-icon="bars" onclick="afficher_horaire()" class="show-page-loading-msg" data-textonly="false" data-textvisible="false" data-msgtext="">Horaire des cours</a></li>
                          <li>
                      
                          </li>
                          <li><a href="#" data-icon="user" onclick="allStudent()">Elèves</a></li>
                          <li><a href="./" target="_blank" data-transition="flip" id="coffee" data-icon="back" onclick="document.getElementById('cadre').style.width = '80%';">Retour</a></li>
                      </ul>
                      </div>
                  </div>
                </div><!-- /navbar -->             
    </div>

<div role="main" class="ui-content jqm-content jqm-fullwidth" style="height: 600px;">
  
<transition 
name="fade"
appear
enter-active-class="animated bounce"
leave-active-class="animated shake"
>
<div class="ui-body ui-body-c ui-corner-all" v-if="show">
        <strong>Mr / Mme <a href="#profilAdmin" data-rel="popup"><?php echo $dataUser['noms_admin']; ?></a></strong>, vous utilisez <a href="#info" data-rel="popup">Kartable </a>depuis :
        <span id="userAgent"></span>
</div>
</transition>
<script>
  document.getElementById("userAgent").innerText = navigator.userAgent;
</script>

  <iframe src="./kartable_eleve.php?id_promo=<?php echo $data['id_promotion'] ?>" frameborder="0" style="height: 100%;width: 100%;" id="myframes" data-transition="flip"></iframe>

</div><!--main-->  

  <div data-role="footer" data-position="fixed" data-theme="c">
		<div data-role="navbar">
			<ul>
				<li><a href="#" data-ajax="false" onclick="ouvrir_bulletin()">Calculator</a></li>
				<li><a href="#" data-ajax="false" class="ui-btn-active ui-state-persist" onclick="registre_appel()">Registre d'appel</a></li>
				<li><a href="#" data-ajax="false" onclick="ouvrir_palmares()">Palmarès</a></li>
			</ul>
		</div>
		<h4 style="display:none;">Footer</h4>
	</div>

<script type="text/javascript">

 function  timetable()
{
  var myframe = document.getElementById('myframes');
 // myframe = myframe.contentDocument || myframe.document;
 myframe.src = "kartable_horaire.php?id_promo=<?php echo $data['id_promotion'] ?>";
}
function  allStudent()
{
  var myframe = document.getElementById('myframes');
 // myframe = myframe.contentDocument || myframe.document;
 myframe.src = "kartable_eleve.php?id_promo=<?php echo $data['id_promotion'] ?>";
}

function excelStudent()
{
  var myframe = document.getElementById('myframes');
 // myframe = myframe.contentDocument || myframe.document;
 myframe.src = "Excel_eleve.php";
}

function showTextEditor()
{
  var myframe = document.getElementById('myframes');
  myframe.src = "kartable_editeur_texte.html";
}

function openExcel()
{
  var myframe = document.getElementById('myframes');
  myframe.src = "kartable_bulletin.php";
}

function ouvrir_bulletin()
{
  var myframe = document.getElementById('myframes');
  myframe.src = "./BULLETINS/";
}

function ouvrir_palmares()
{
  var myframe = document.getElementById('myframes');
  myframe.src = "./PALMARES/";
}

function show_bulletin()
{
 var myframe = document.getElementById('myframes');
// myframe = myframe.contentDocument || myframe.document;
myframe.src = "./kartable_bulletin.php";
}

function registre_appel()
{
  var myframe = document.getElementById('myframes');
  myframe.src = "./cmp_registre_appel.php?id_promo=<?php echo $data['id_promotion'] ?>";
}

function controler_frais()
{
  var myframe = document.getElementById('myframes');
  myframe.src = "./cmp_ctrl_frais.php?id_promo=<?php echo $data['id_promotion'] ?>";
}

function registre_appel_story()
{
  var myframe = document.getElementById('myframes');
  myframe.src = "./cmp_registre_appel_story.php?id_promo=<?php echo $data['id_promotion'] ?>";
}

function ajouter_cours()
{
  var myframe = document.getElementById('myframes');
  myframe.src = "./cmp_ajouter_cours.php?id_promo=<?php echo $data['id_promotion']?>";
}

function afficher_horaire()
{
  var myframe = document.getElementById('myframes');
  myframe.src = "./cmp_afficher_horaire.php?id_promo=<?php echo $data['id_promotion']?>";
}

function enseignants_affectes()
{
  var myframe = document.getElementById('myframes');
  myframe.src = "./cmp_enseignants_affectes.php?id_promo=<?php echo $data['id_promotion']?>";
}

function cours_dispenses()
{
  var myframe = document.getElementById('myframes');
  myframe.src = "./cmp_cours_dispenses.php?id_promo=<?php echo $data['id_promotion']?>";
}
  </script>

</div> 


<!--Script vanilla pour le champ de texte textarea-->
<script>
var zonetext = document.getElementById('description');
if(zonetext != NULL)
{
  zonetext.addEventListener('focus', function(e) {
  e.target.placeholder = "Le nombre de caractère est limité à 255";
  }, true);
  zonetext.addEventListener('blur', function(e) {
  e.target.placeholder = "";
  }, true);

}  

</script>
<!--Script vanilla pour l'upload de l'image-->
<script>
  function uploadEnd(error, path) {
if (error === 'OK') {
document.getElementById('uploadStatus').innerHTML = '<a href="./images/' + path + '">Upload effectué !</a><br/><a href="./images/' + path +
'"><img src="./images/' + path + '" style="width:250px;height:200px;"/></a>';
document.getElementById('fichier').innerHTML = path;
} else {
document.getElementById('uploadStatus').innerHTML = error;
}
}
document.getElementById('uploadForm').addEventListener('submit',
function() {
document.getElementById('uploadStatus').innerHTML ='Chargement...';
}, true);
  </script>

<script src="./main.js"></script>
<?php include("jsfiles.html"); ?>

<script type="text/javascript">
    // Animations initialization
    new WOW().init();
  </script>

</body>
 </html>