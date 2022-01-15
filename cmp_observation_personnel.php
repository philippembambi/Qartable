<?php
require('database.php');
$get_id_personnel = $_GET['id_personnel'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
<!--Css Jquey mobile-->
    <link rel="stylesheet" href="./jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
    <link rel="stylesheet" href="./assets/css/jqm-demos.css">
<!--Css importées-->
    <link rel="stylesheet" href="./portofolio/animate.css">
      <link href="./portofolio/prettyPhoto.css" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="./css/style.css"/>
      <link href="./managerCss/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="./css/font-awesome.css">

     
      <!-- Material Design Bootstrap -->
      <link href="./managerCss/mdb.css" rel="stylesheet">
      <!-- Your custom styles (optional) -->
      <link href="./managerCss/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/addStyle.css">
    <link rel="stylesheet" href="./css/theme_classic.css">
   <!--Vue.js--> 
  <script src="./vue.js"> </script>
  <script src="./managerJs/myscripts.js"></script>
  <script src="./kartable_ajax.js"></script>
  
<!--Js Jquery mobile-->
    <script src="./jquery-2.1.1.min.js"></script>
    <script src="./jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>
  
  </head>
  <script>
$.mobile.document.on( "pagebeforeshow", function(){
  make_sleep();
});
  </script>
<style>
  .row {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  margin-right: -15px;
  margin-left: -15px;
}
</style>
<body>

<div data-role="page" class="jqm-demos ui-responsive-panel" id="page1" data-title="Détails sur le personnel" data-url="details_perso" data-theme="<?php echo $theme; ?>">


<?php
$classes=$db->prepare('SELECT * FROM kartable_personnel LEFT JOIN affectation_cours
ON kartable_personnel.id_personel = affectation_cours.id_enseignant LEFT JOIN kartable_horaire
ON affectation_cours.id_affectation = kartable_horaire.id_affectation LEFT JOIN kartable_promotion
ON kartable_horaire.id_promo = kartable_promotion.id_promotion
WHERE affectation_cours.id_enseignant = :idPerso GROUP BY kartable_horaire.id_promo');
$classes->bindValue(':idPerso', $get_id_personnel, PDO::PARAM_INT);
$classes->execute();
?>
    <!-- Popups for lightbox images -->
    <div id="classes" class="ui-content" data-role="popup" data-overlay-theme="c" data-theme="d" style="width: 300px;">
    <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
              
            <div data-role="collapsible" data-inset="false">
<h6 style="width: 100%;margin-left: 1px;margin-top: -5%;">Classes affectées</h6>
        
            <hr>
      <ul>
      <?php
      while ($liste_classes = $classes->fetch())
      {
        $classe_promo = ($liste_classes['classe_promo'] > 1 )?($liste_classes['classe_promo']." ième"):($liste_classes['classe_promo']." ière année");
        $option_promo = $liste_classes['option_promo'];
      
        ?>
      <li style="margin-left: 3%;">*  <?php echo $classe_promo. ' '.$option_promo; ?></li>
      <hr>
      <?php }  ?>

        </ul>
</div>
</div>

<?php
$classes=$db->prepare('SELECT * FROM kartable_personnel LEFT JOIN affectation_cours
ON kartable_personnel.id_personel = affectation_cours.id_enseignant LEFT JOIN kartable_horaire
ON affectation_cours.id_affectation = kartable_horaire.id_affectation LEFT JOIN kartable_cours
ON affectation_cours.id_cours = kartable_cours.id_cours
WHERE affectation_cours.id_enseignant = :idPerso');
$classes->bindValue(':idPerso', $get_id_personnel, PDO::PARAM_INT);
$classes->execute();
?>
    <!-- Popups for lightbox images -->
    <div id="cours" class="ui-content" data-role="popup" data-overlay-theme="c" data-theme="d" style="width: 300px;">
    <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
              
    <div data-role="collapsible" data-inset="false">
<h6 style="width: 100%;margin-left: 1px;margin-top: -5%;">Cours dispensés</h6>
            <hr>
      <ul>
      <?php
      while ($liste_classes = $classes->fetch())
      {
      
        ?>
      <li style="margin-left: 3%;">*  <?php echo $liste_classes['intitule_cours']; ?></li>
      <hr>
      <?php }  ?>

        </ul>
</div>
</div>


<div data-role="header" data-theme="<?php echo $theme; ?>">
<h1 style="color: white;">Détails sur le personnel</h1>
		<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" rel="external" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-ajax="false">Back</a>
		<a href="#" onclick="window.location.reload();" rel="external" data-shadow="false" data-iconshadow="false" data-icon="recycle" data-iconpos="notext" data-ajax="false">Back</a>
  </div><!-- /header -->
	
    <div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->

    <?php
$q=$db->prepare('SELECT*  FROM kartable_personnel LEFT JOIN kartable_admin 
ON kartable_admin.id_admin = kartable_personnel.id_admin
WHERE id_personel = :id');
$q->bindValue(':id', $get_id_personnel, PDO::PARAM_INT);
$q->execute();
while ($data = $q->fetch())
{
?>

  <table data-role="table" data-mode="columntoggle" data-column-btn-text="Affichage..." data-column-btn-theme="a" class="phone-compare ui-shadow table-stroke" data-theme="<?php echo $theme; ?>">
 <thead>    
        <tr style="font-family: leelawadee;">
          <th class="label" data-priority="<?php echo $data['id_personel']; ?>">Noms</th>
  
          <th data-priority="<?php echo $data1['id_personel'];?>"><?php echo $data['id_personel'];?></th>
    <th>
            <h4 style="color:#539fdd;"><?php echo $data['noms_personel']; ?></h4>
        </th>

        </tr>
       
      </thead>

      <tbody>

      <tr class="photos">       
          <th class="label">Photo</th>

          <td>
            <a href="<?php echo '#'.$data['id_personel']?>" data-rel="popup" data-position-to="window">
              <?php 
              if($data['photo'] != '')
              {
                echo'<img src="./images/'.$data['photo'].'" alt="Image" style="heigth: 180px; width: 180px;"/>'; 
              }
              else{
                echo'<img src="./images/avatar.png" alt="Image" style="heigth: 120px; width: 150px;"/>'; 
             
              }
              ?>
            </a>
          </td>  
          <td>
          <ul style="font-size: 18px;font-family: leelawadee;">
<li>Fonction :  <strong style="color:#539fdd;font-weight: bold;"> <?php echo $data['fonction']; ?> </strong></li><br>

<li>Niveau d'études : <strong style="color:#539fdd;font-weight: bold;"> <?php echo $data['etudes']; ?></strong> </li> <br>

<?php
$nbre_cours=$db->prepare('SELECT COUNT(*) AS nbre_cours FROM kartable_personnel LEFT JOIN affectation_cours
ON kartable_personnel.id_personel = affectation_cours.id_enseignant 
WHERE affectation_cours.id_enseignant = :idPerso');
$nbre_cours->bindValue(':idPerso', $data['id_personel'], PDO::PARAM_INT);
$nbre_cours->execute();
$total_cours = $nbre_cours->fetch();        
?>

<li>Nombre de cours dispensés : <strong style="color:#539fdd;font-weight: bold;"> <?php echo $total_cours['nbre_cours']; ?></strong> </li> <br>

<?php
$nbre_classes=$db->prepare('SELECT COUNT(*) AS nbre_classes FROM kartable_personnel LEFT JOIN affectation_cours
ON kartable_personnel.id_personel = affectation_cours.id_enseignant LEFT JOIN kartable_horaire
ON affectation_cours.id_affectation = kartable_horaire.id_affectation 
WHERE affectation_cours.id_enseignant = :idPerso GROUP BY kartable_horaire.id_promo');
$nbre_classes->bindValue(':idPerso', $data['id_personel'], PDO::PARAM_INT);
$nbre_classes->execute();
$total_classes = $nbre_classes->fetch();
?>

<li>Nombre de classes affectées : <strong style="color:#539fdd;font-weight: bold;"> <?php echo $total_classes['nbre_classes']; ?></strong> </li> 

          <?php
$nbre_absence=$db->prepare('SELECT COUNT(*) AS nbre_absence FROM kartable_pointage LEFT JOIN kartable_personnel
ON kartable_pointage.id_personnel = kartable_personnel.id_personel 
WHERE kartable_personnel.id_personel = :idPerso AND kartable_pointage.pointe_present = :valeurPointage');
$nbre_absence->bindValue(':idPerso', $data['id_personel'], PDO::PARAM_INT);
$nbre_absence->bindValue(':valeurPointage', 'Non', PDO::PARAM_STR);
$nbre_absence->execute();
$nbre_total = $nbre_absence->fetch();
          ?>

          <li>
            Nombre d'absence : <strong style="font-weight: bold;color:#539fdd;"> <?php echo $nbre_total['nbre_absence']; ?></strong>
          </li> <br>

          <li>Nombre de mois impayés : <strong style="color:#539fdd;font-weight: bold;"> <?php echo 0; ?></strong> </li> 
     
        </ul>
          </td>     
        </tr>
     <tr>
          <th class="label"> Informations</th>
      
        <td>
          <div data-role="footer">
            <div data-role="navbar" data-iconpos="left">
                <ul>
                  <li><a href="#" data-rel="popup" data-transition="pop" data-icon="clock" class="ui-btn-active"> Mettre à jour</a></li>
                 <li><a href="filtre_salaire_by_nom_personnel.php?personnel=<?php echo $data['id_personel']; ?>" rel="external" data-icon="grid" data-ajax="false">Bulletin de paie</a> </li>
                </ul>
            </div><!-- /navbar -->
        </div><!-- /footer -->
        </td>

        <td>
          <div data-role="footer">
            <div data-role="navbar" data-iconpos="left">
                <ul>
                  <li><a href="#cours" data-rel="popup" data-position-to="window" data-transition="pop" data-icon="action" class="ui-btn-active">Cours dipensés</a></li>
                 <li><a href="#classes" data-rel="popup" data-position-to="window" data-transition="pop" data-icon="location">Classes affectées</a></li>
                </ul>
            </div><!-- /navbar -->
        </div><!-- /footer -->
        </td>

        </tr>
      </tbody>
  </table>
  <?php  } ?>

  </div>
  </div>


</div>
  </div>