<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
<!--Css Jquey mobile-->
    <link rel="stylesheet" href="jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
    <link rel="stylesheet" href="assets/css/jqm-demos.css">

    <link rel="stylesheet" href="./addStyle.css">
    <link rel="stylesheet" href="./css/theme_classic.css">

   <!--Vue.js--> 
  <script src="CodeJs/vue.js"> </script>
  <script src="managerJs/validation.js"></script>
  <script src="./kartable_ajax.js"></script>
  
<!--Js Jquery mobile-->
    <script src="jquery-2.1.1.min.js"></script>
    <script src="jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <script>
  
$.mobile.document.on( "pagebeforeshow", function(){
  make_sleep();

});
  </script>
</head>
<body>
<div data-role="page" class="jqm-demos ui-responsive-panel" data-theme="c" id="page1" data-title="Index Kartable">

<div data-role="header" data-theme="b">
<h1 style="color: white;">Information sur le serveur</h1>
		<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" rel="external" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-ajax="false">Back</a>
		<a href="#" onclick="window.location.reload();" rel="external" data-shadow="false" data-iconshadow="false" data-icon="recycle" data-iconpos="notext" data-ajax="false">Back</a>
  </div><!-- /header -->

  <div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->

  <ul data-role="listview" data-inset="true">

  <li data-role="list-divider" data-theme="a">Nom du serveur</li>
    <li data-theme="d"><a href="#">
    <h2><?php echo $_SERVER['SERVER_NAME']; ?></h2>
    <p>Il s'agit du nom complet du serveur qui peut être soit un nom de domaine soit une adresse IP si aucune configuration du nom de domaine n'a été faite.</p>
    </a></li>

<hr>
    <li data-role="list-divider" data-theme="a">Numéro de Port</li>
    <li><a href="#">
    <h2><?php echo $_SERVER['SERVER_PORT']; ?></h2>
    <p>Le port qui a été défini lors de la configuration dans le fichier Php.Ini ou fichier de configuration</p>
    </a></li>
<hr>
    <li data-role="list-divider" data-theme="a">Adminstrateur principal</li>
    <li><a href="#">
    <h2><?php echo $_SERVER['SERVER_ADMIN']; ?></h2>
    <p>Il s'agit de l'administrateur illigible pour les manipulations et configurations au niveau du serveur d'application ou de serveur des bases de données. </p>
    </a></li>
<hr>
    
    <li data-role="list-divider" data-theme="a">Adresse IP du serveur</li>
    <li><a href="#">
    <h2><?php echo $_SERVER['SERVER_ADDR']; ?></h2>
    <p>C'est une adresse logique qui identifie la machine (serveur en l'occurence) sur ce réseau. </p>
    </a></li>
<hr>
    <li data-role="list-divider" data-theme="a">Protocole de transport</li>
    <li><a href="#">
    <h2>TCP</h2>
    <p>Voir le fichier config.inc.php pour visualiser les autres détails.</p>
    </a></li>
<hr>
    <li data-role="list-divider" data-theme="a">Logiciel système</li>
    <li><a href="#">
    <h2><?php echo $_SERVER['SERVER_SOFTWARE']; ?></h2>
    </a></li>
<hr>
    <li data-role="list-divider" data-theme="a">Protocole du serveur</li>
    <li><a href="#">
    <h2><?php echo $_SERVER['SERVER_PROTOCOL']; ?></h2>
    </a></li>

</ul>

</div>
</div>