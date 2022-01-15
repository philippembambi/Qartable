<?php
require('database.php');
$get_id_eleve = $_GET['id_eleve'];
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

<div data-role="page" class="jqm-demos ui-responsive-panel" id="page1" data-title="Détails sur l'eleve" data-url="details_eleves" data-theme="a">


<div data-role="header" data-theme="<?php echo $theme; ?>">
<h1 style="color: white;">Détails sur l'élève</h1>
<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" rel="external" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-ajax="false">Back</a>
  	<a href="#" onclick="window.location.reload();" rel="external" data-shadow="false" data-iconshadow="false" data-icon="recycle" data-iconpos="notext" data-ajax="false">Back</a>
  	</div><!-- /header -->
	
    <div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->

<?php
$query=$db->prepare('SELECT*  FROM kartable_eleves LEFT JOIN kartable_promotion
ON kartable_eleves.promotion_id = kartable_promotion.id_promotion LEFT JOIN kartable_admin 
ON kartable_eleves.admin_id = kartable_admin.id_admin WHERE id_eleve = :get_id_eleve'); 
$query->bindValue(':get_id_eleve', $get_id_eleve, PDO::PARAM_INT);
$query->execute();
while ($data = $query->fetch())
{
  $classe_promo = ($data['classe_promo'] > 1 )?($data['classe_promo']." ième"):($data['classe_promo']." ière année");
  $option_promo = $data['option_promo'];

?>

<?php
$montant_total_frais=$db->prepare('SELECT SUM(montant) AS montant_total_frais FROM kartable_frais_scolaire LEFT JOIN kartable_eleves
ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve
WHERE kartable_frais_scolaire.id_eleve = :get_id_eleve');
$montant_total_frais->bindValue(':get_id_eleve', $get_id_eleve, PDO::PARAM_INT);
$montant_total_frais->execute();
$total_frais = $montant_total_frais->fetch();

$solde=$db->prepare('SELECT montant_modalite  FROM kartable_modalite WHERE modalite = "Solde"');
$solde->execute();
$data_solde = $solde->fetch();
$montant_solde = $data_solde['montant_modalite'];

$dette_total = (double) $montant_solde - (double) $total_frais['montant_total_frais'];
?>

  <table data-role="table" data-mode="columntoggle" data-column-btn-text="Affichage..." data-column-btn-theme="b" class="phone-compare ui-shadow table-stroke" data-theme="<?php echo $theme; ?>">
 <thead>    
        <tr style="font-family: leelawadee;">
          <th class="label" data-priority="<?php echo (!empty($data['id_eleve']))?$data['id_eleve']:"Vide"; ?>">Noms</th>
  
<?php
$q=$db->prepare('SELECT*  FROM kartable_eleves WHERE id_eleve = :id');
$q->bindValue(':id', $data['id_eleve'], PDO::PARAM_INT);
$q->execute();
while ($data1 = $q->fetch())
{
?>
          <th data-priority="<?php echo $data1['id_eleve'];?>" style="font-size: 20px;font-family: leelawadee;"><?php echo $data['noms_eleve']; ?></th>
<?php  } ?>          
      <th>
            <h4 style="color: white">Observation</h4>
        </th>

        </tr>
       
      </thead>

      <tbody>

      <tr class="photos">       
          <th class="label">Photo</th>

          <td>
            <a href="<?php echo '#'.$data['id_eleve']?>" data-rel="popup" data-position-to="window">
            <?php 
              if($data['photo_eleve'] != '')
              {
                echo'<img src="./images/'.$data['photo_eleve'].'" alt="Image" style="heigth: 180px; width: 180px;"/>'; }
              else{
                echo'<img src="./images/avatar.png" alt="Image" style="heigth: 120px; width: 150px;"/>';
              }
              ?>
            </a>
          </td>  
          <td>
          <ul style="font-size: 18px;font-family: leelawadee;">
          <li>Classe :              <span style="color: #539fdd;font-weight: bold;"><?php echo $classe_promo. ' '.$option_promo; ?></span></li><br>
          <li>A déjà payé : <span style="color: #539fdd;font-weight: bold;"><?php echo $total_frais['montant_total_frais'].' $'; ?> </span></li><br>
          <li>Dette : <span style="color: #539fdd;font-weight: bold;"><?php echo $dette_total.' $   sur   <u>'.$data_solde['montant_modalite'].'$ fixé </u>'; ?></span></li><br>
          <li>Nombre de convocation : <span style="color: #539fdd;font-weight: bold;"> 0</span></li>
          <br>
          <?php
$nbre_absence=$db->prepare('SELECT COUNT(*) AS nbre_absence FROM kartable_registre_appel 
LEFT JOIN kartable_eleves ON kartable_registre_appel.id_eleve = kartable_eleves.id_eleve 
WHERE kartable_eleves.id_eleve = :idPerso AND kartable_registre_appel.pointe_present = :valeurPointage');
$nbre_absence->bindValue(':idPerso', $data['id_eleve'], PDO::PARAM_INT);
$nbre_absence->bindValue(':valeurPointage', 'Non', PDO::PARAM_STR);
$nbre_absence->execute();
$nbre_total = $nbre_absence->fetch();
          ?>

          <li>
            Nombre d'absences : <strong style="font-weight: bold;color: #539fdd;"> <?php echo $nbre_total['nbre_absence']; ?></strong>
          </li>
        </ul>
          </td>     
        </tr>
     <tr>
          <th class="label"> Informations</th>
      
        <td>
          <div data-role="footer">
            <div data-role="navbar" data-iconpos="left">
                <ul>
                <li><a href="./dossier_cmp_frais_scolaire/filtre_paiement_nom.php?id_eleve=<?php echo $data['id_eleve']; ?>&nom_eleve=<?php echo $data['noms_eleve']; ?>"  data-icon="gear" class="ui-btn-active" rel="external"> Historique des frais</a></li>
                <li>
                 <a href="kartable_print_pdf.php?action=formulaire&amp;id_eleve=<?php echo $data['id_eleve'] ?>" data-icon="grid" >Billet de vacances</a></li>
                </ul>
            </div><!-- /navbar -->
        </div><!-- /footer -->
        </td>

        <td>
          <div data-role="footer">
            <div data-role="navbar" data-iconpos="left">
                <ul>
                  <li><a href="#" data-rel="popup" data-transition="pop" data-icon="gear" class="ui-btn-active">Nouvelle convocation</a></li>
                 <li><a href="#parametre" data-rel="popup" data-icon="grid" >Plus...</a></li>
                </ul>
            </div><!-- /navbar -->
        </div><!-- /footer -->
        </td>

        </tr>
      </tbody>
  </table>
  <?php  } ?>
 

<?php
  $requete=$db->prepare('SELECT*  FROM kartable_promotion LEFT JOIN kartable_eleves
  ON promotion_id = id_promotion LEFT JOIN kartable_tuteur ON kartable_tuteur.id_tuteur = kartable_eleves.id_tuteur 
  WHERE kartable_eleves.id_eleve = :get_id_eleve');
  $requete->bindValue(':get_id_eleve', $get_id_eleve, PDO::PARAM_INT);
  $requete->execute();

while ($data3 = $requete->fetch())
{
?>
    <!-- Popups for lightbox images -->
    <div id="<?php echo $data3['id_eleve']?>" data-role="popup" data-overlay-theme="b" style="background-color:white;">
      
    <?php echo'<img src="./images/'.$data3['photo_eleve'].'" alt="Image" style="width:350px;height: 250px;"/>'; ?>
            
      <ul>
          <li style="width: 350px;">
          <?php 
          if(!empty($data3['info_supplementaire'])) 
          { 
            echo $data3['info_supplementaire'];
           }
           else {
             echo "Aucune information relative à cet (te) élève n'est disponible. ";
           } ?></li>
        </ul>

<div data-role="collapsible" data-inset="false">
<h4 style="width: 100%;margin-left: 1px;">Informations sur le tuteur</h4>
<ul>
<li>Nom du tuteur : <?php echo $data3['t_noms']; ?></li>
<li>Nationalite : <?php echo $data3['t_nationalite']; ?></li>
<li>Profession : <?php echo $data3['t_profession']; ?></li>
<li>Adresse : <?php echo $data3['t_adresse']; ?></li>
<li>Téléphone : <?php echo $data3['t_tel']; ?></li>
</ul>
</div>
</div>
    <?php  } ?>

  </div>
  </div>

</div>
  </div>