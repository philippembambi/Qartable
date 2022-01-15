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
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <link rel="shortcut icon" type="image/png" href="./images/logo.png">
    <!--Css Jquey mobile-->
    <!--philippembambi413@gmail.com-->
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
    <!-- Your custom styles (optional) -->
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
    
<!--Les scripts-->
<script type="text/javascript">
      $.mobile.document.on( "pagebeforeshow", function(){
      /**   var psw = localStorage.getItem('adminPsw');
      if(!(localStorage.getItem('adminPsw')))
      {
      document.getElementById("loginadmin").click();
      } **/

      setTimeout(function(){
      document.getElementById("infoKartable").click();
      }, 2000);
      });

      $(document).on('mobileinit', function(){
      $.mobile.defaultPageTransition = 'slide';
      });
</script>

<!--Les styles-->
<style>
  .ui-btn-active {
    background-color: #3388cc;
    border-color: #3388cc;
  }
  li a:after {
    background-color: #3388cc;
    border-color: #3388cc;
  }

  /* --- Blog Comments --- */
  .blog-comments {
	  margin-top:40px;
  }

  .blog-comments .media {
	  margin-top:20px;
	  margin-bottom:20px;
  }

  .blog-comments .media .media {
	  margin-left:20px;
  }

  .blog-comments .media .media:nth-last-child(1) {
	  margin-bottom:0px;
  }

  .blog-comments .media .media-body {
	  padding:10px;
	  background-color:#fff;
	  border-radius:0px 4px 4px;
  }

  .blog-comments .media .media-left:before {
	  content:"";
	  position:absolute;
	  right:0;
	  top:0;
	  border-style: solid;
	  border-width: 0px 15px 15px;
	  border-color: transparent #fff transparent transparent;
  }

  .blog-comments .media-left {
	  position:relative;
	  padding-right:20px;
  }

  .blog-comments .media-left img {
	  width:70px;
	  height:70px;
	  background-color:#fff;
	  border-radius:50%;
  }

  .blog-comments .media .date-reply {
	  font-size:12px;
	  text-transform:uppercase;
	  color:#374050;
  }
  .blog-comments .media .date-reply .reply {
	  margin-left:15px;
  }

  /* --- Blog Reply Form --- */
  .blog-reply-form {
	  margin-top:40px;
  }

  .blog-reply-form .input {
	  margin-bottom:20px;
  }

  .blog-reply-form .input.name-input , .blog-reply-form .input.email-input {
	  width: calc(50% - 10px);
	  float:left;
  }

  .blog-reply-form .input.email-input {
	  margin-left: 20px;
  }
  .fade-enter {
    opacity: 0;
  }
  .fade-enter-active {
    transition: opacity 1s;
  }
  .fade-leave {

  } 
  .fade-leave-active {
    transition: opacity 1s;
    opacity: 0;
  }
  .slide-enter {

  }
  .slide-enter-active {

  }
  .slide-leave {

  }
  .slide-leave-active {
    animation: slide-out 1s ease-out forwards;
  }
  @keyframes slide-in {
    from {
    transform: translateY(20px);
  }
  to {
    transform: translateY(0);

  }
  }
  @keyframes slide-out {
  from {
    transform: translateY(0);
  }
  to {
    transform: translateY(20px);

  }
  }

</style>

</head>

<body onload="testerNavigateur()">

<?php
$query=$db->prepare('SELECT*  FROM kartable_admin WHERE id_admin = :id_admin');
$query->bindValue(':id_admin', $id_admin, PDO::PARAM_INT);
$query->execute();
$dataUser = $query->fetch();
?>
  

<!--Page index-->
<div data-role="page" class="jqm-demos ui-responsive-panel" data-theme="c" id="page1" data-title="Ui gestion des élèves">
<!--composant formulaire-->
<app-menu></app-menu>
<?php include("./dossier_menu/menu_gestion_eleve.php"); ?>

<app-formulaire></app-formulaire>
<?php include("./template_formulaire.php"); ?>
<?php include("template_formulaire_personnel.php"); ?>
<!--composant menu-->

<?php include("./dossier_popup/template_popup.php"); ?>

<div data-role="popup" class="ui-content" data-theme="c" id="profilAdmin">
<transition 
name="fade"
appear
enter-active-class="animated bounce"
leave-active-class="animated shake"
>
<div class="blog-comments" style="height: 120px;margin-top: -2%;">
							<div class="media">
								<div class="media-left">
                                <img src="images/user.png" class="rounded-circle img-responsive" alt="Avatar photo">
                                </div>
								<div class="media-body" style="width:100%;">
									<h5 class="media-heading">
                                    <?php echo $dataUser['noms_admin']; ?>
                                </h5>
                                    <div class="date-reply">
                                    <a href="./kartable_moteur.php?action=deconnectAdmin" rel="external" class="ui-btn ui-corner-all ui-icon-check ui-btn-icon-left ui-shadow ui-btn-inline ui-btn-b">Se deconnecter</a>
                                </div>
                                    </div></div>
</div>
</transition>

</div>

<div data-role="popup" id="popupromo" data-theme="c" class="ui-corner-all">

<form method="GET" action="kartable_promo.php" name="forms">
  <div style="padding:10px 20px;">
   <label for="number-pattern">Entrer une Classe :</label>
   <input type="number" id="Maclasse" name="Maclasse" pattern="[1-6]*">

   <fieldset data-role="controlgroup">
    <legend>Choisir une option / section :</legend>
    <input type="checkbox" name="Masection" id="checkbox-4a" checked="" value="CTEB">
    <label for="checkbox-4a">CTEB</label>
    <input type="checkbox" name="Masection" id="checkbox-1a" value="biochimie">
    <label for="checkbox-1a">Chimie-Biologie</label>
    <input type="checkbox" name="Masection" id="checkbox-2a" value="latinphilo">
    <label for="checkbox-2a">Latin-philo</label>
    <input type="checkbox" name="Masection" id="checkbox-3a" value="commerciale">
    <label for="checkbox-3a">Commerciale informatique</label>
  </fieldset>

  <a href="#" rel="external" target="_blank" onclick="document.forms.submit()" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-check">Valider</a>
  </div>
</form>

</div>


<!-- header -->
<div data-role="header" style="overflow:hidden;" data-theme="c">
      <section class="hero-area-fix" data-theme="c">
            <div class="hero-area" id="water">

            <a href="#info" data-rel="popup" id="infoKartable">
            <span style="margin-left: 1%;"><img src="./images/logo.png" alt="" style="height: 60px;" id="photologo"></span>
            </a>

                  <div class="hero-text">
                        <div id="typed-strings">
                              <h3>Gestion des élèves</h3>
                              <h2><span>Par StarTech-DRC</span></h2>
                                </div>
                                <h2><span id="typed"></span></h2>
                            </div>
                            <a href="#" v-on:click="show = !show" class="ui-btn ui-icon-info ui-btn-icon-notext" style="float:right;margin-right: 2%;">Icon only</a>

                          </div>
                      </section>
      
                      <div data-role="navbar">
                        <div data-role="header" class="nav-glyphish-example" data-theme="c">
                          <div data-role="navbar" class="nav-glyphish-example" data-grid="d">
                          <ul>
                              <li><a href="#left-panel" data-icon="grid" onclick="document.getElementById('cadre').style.width = '95%';">Menu</a></li>
                              <li>
                                <button data-icon="user" data-toggle="modal" data-target="#eleve1">Formulaire Elève</button></li> 
                              <li></li>
                              <li><a href="#profilAdmin" data-rel="popup" data-icon="user">Profil Admin</a></li>
                              <li><a href="#" data-transition="flip" id="coffee" data-icon="bars" class="show-page-loading-msg" data-textonly="false" data-textvisible="false" data-msgtext="" data-inline="true">Calendrier scolaire</a>
                            </li>
                          </ul>
                          </div>
                      </div>  </div><!-- /navbar -->  
</div><!-- /header -->

<div data-role="main" class="ui-content jqm-content jqm-fullwidth" style="height: 600px;" > <!--Debut de main-->

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

<iframe src="./iframe_index_content.php" frameborder="0" style="height: 100%;width: 100%;" id="myframes" data-transition="flip" ></iframe>

</div> <!--Fin de main-->

    <div data-role="footer" data-position="fixed" data-theme="c">
      <div data-role="navbar">
        <ul>
        <li><a href="./kartable_comptabilites.php" target="_blank">Calendrier scolaire</a></li>
          <li><a href="#" data-ajax="false" class="ui-btn-active ui-state-persist" onclick="show_index_content()">Index</a></li>
          <li><a href="#" data-ajax="false" onclick="">A propos</a></li>
        </ul>
      </div>
      <h4 style="display:none;">Footer</h4>
    </div>  <!--Fin de footer-->

    </div> <!--Fin de la page-->


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
  var horaire = document.getElementById('horaire');
</script>

<!--Script vanilla pour l'upload de l'image-->
<script>
  function uploadEnd(error, path) {
  if (error === 'OK') {
  document.getElementById('uploadStatus').innerHTML = '<a href="./images/' + path + '">Upload effectué !</a><br/><a href="./images/' + path +
  '"><img src="./images/' + path + '" style="width:250px;height:200px;"/></a>';
  document.getElementById('fichier').innerHTML = path;
  document.getElementById('avatar').src = './images/' + path;
  } else {
  document.getElementById('uploadStatus').innerHTML = error;
  }
  }
  document.getElementById('uploadForm').addEventListener('submit',
  function() {
  document.getElementById('uploadStatus').innerHTML ='Chargement...';
  }, true);
</script>

<!--Upload des images 2-->
<script>
  function uploadEnd2(error, path) {
  if (error === 'OK') {
  document.getElementById('uploadStatus2').innerHTML = '<a href="./images/' + path + '">Upload effectué !</a><br/><a href="./images/' + path +
  '"><img src="./images/' + path + '" style="width:250px;height:200px;"/></a>';
  document.getElementById('fichier2').innerHTML = path;
  document.getElementById('avatar2').src = './images/' + path;
  } else {
  document.getElementById('uploadStatus2').innerHTML = error;
  }
  }
  document.getElementById('uploadForm2').addEventListener('submit',
  function() {
  document.getElementById('uploadStatus2').innerHTML ='Chargement...';
  }, true);
</script>


<script type="text/javascript">
// myframe = myframe.contentDocument || myframe.document;
function listing()
{
 var myframe = document.getElementById('myframes');
 myframe.src = "./listing_personnel.php";
}

function show_index_content()
{
 var myframe = document.getElementById('myframes');
 myframe.src = "./iframe_index_content.php";
}

function show_affectation()
{
 var myframe = document.getElementById('myframes');
 myframe.src = "./cmp_affecter_cours.php";
}

function show_all()
{
 var myframe = document.getElementById('myframes');
 myframe.src = "./kartable_show_all_students.php";
}

function show_bulletin()
{
 var myframe = document.getElementById('myframes');
 myframe.src = "./BULLETINS/";
}

function pointage()
{
  var myframe = document.getElementById('myframes');
  myframe.src = "./cmp_pointage.php";
}

function historique_pointage()
{
  var myframe = document.getElementById('myframes');
  myframe.src = "./cmp_pointage_story.php";
}

function show_classes()
{
 var myframe = document.getElementById('myframes');
 myframe.src = "./cmp_show_classes.php";
}

function messagerie_privee()
{
 var myframe = document.getElementById('myframes');
 myframe.src = "./kartable_messagerie.php";
}

function messages_envoyes()
{
 var myframe = document.getElementById('myframes');
 myframe.src = "./kartable_msg_envoye.php";
}

function boite_reception()
{
 var myframe = document.getElementById('myframes');
 myframe.src = "./kartable_msg_boite.php";
}
function crawl_page()
{
  var myframe = document.getElementById('myframes');
  myframe.src = "kartable_moteur.php?action=crawl_page&lien=https://www.eduquepsp.education";
}

function crawl_unicef()
{
  var myframe = document.getElementById('myframes');
  myframe.src = "kartable_moteur.php?action=crawl_page&lien=https://www.unicef.org/congo/";

}

</script>

<script src="./main.js"></script>
<?php include("jsfiles.html"); ?>

<script type="text/javascript">
    // Animations initialization
    new WOW().init();
</script>

<!--philippembambi413@gmail.com-->
</body>
 </html>