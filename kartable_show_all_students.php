<?php
require('database.php');
include('kartable_debut.php');
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
    <link rel="stylesheet" href="./css/theme_c.css">
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

function PrintDiv() {

var divToPrint = document.getElementById('divToPrint');
var popupWin = window.open('', '_blank', 'width=1500,height=1500');
popupWin.document.open();
popupWin.document.write('<html><head><link rel="stylesheet" href="jquery.mobile-1.4.5/jquery.mobile-1.4.5.css"><link rel="stylesheet" href="./css/theme_classic.css"><link rel="stylesheet" href="./css/bootstrap.css"></head><body onload="window.print()">' +
  divToPrint.innerHTML + '</html>');
popupWin.document.close();
}
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

<div data-role="page" class="jqm-demos ui-responsive-panel" id="page1" data-title="eleve" data-url="list_eleves" data-theme="c">


<div data-role="header" data-theme="a">
<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" rel="external" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-ajax="false">Back</a>
  	<a href="#" onclick="window.location.reload();" rel="external" data-shadow="false" data-iconshadow="false" data-icon="recycle" data-iconpos="notext" data-ajax="false">Back</a>
     </div><!-- /header -->

  <?php
  $total=$db->prepare('SELECT COUNT(*) AS total_eleve FROM kartable_promotion LEFT JOIN kartable_eleves
  ON promotion_id = id_promotion');
  $total->execute();
  $total_eleve = $total->fetch();

  $garcons=$db->prepare('SELECT COUNT(*) AS total_garcons FROM kartable_promotion LEFT JOIN kartable_eleves
  ON promotion_id = id_promotion WHERE sexe_eleve = "M" ');
  $garcons->execute();
  $total_garcons = $garcons->fetch();

  $filles=$db->prepare('SELECT COUNT(*) AS total_filles FROM kartable_promotion LEFT JOIN kartable_eleves
  ON promotion_id = id_promotion WHERE sexe_eleve = "F" ');
  $filles->execute();
  $total_filles = $filles->fetch();
 ?>

  <div class="ui-corner-all custom-corners">
  <div class="ui-body ui-body-c" style="font-weight: bold;margin-left: 3%;">
Effectif total : <span style="color: #3388cc;"> <?php echo $total_eleve['total_eleve'] ?> élèves </span> <span style="margin-left: 32%;">Garçons :  <span style="color: #3388cc;"><?php echo $total_garcons['total_garcons'] ?></span> </span>     <span style="float: right;margin-right: 10%;">Filles : <span style="color: #3388cc;"> <?php echo $total_filles['total_filles'] ?> </span></span>   
</div>	

<div data-role="popup" id="parametre" data-theme="a">
<ul data-role="listview" data-inset="true" style="min-width:210px;">
    <li data-role="list-divider">Choisir une action</li>
    <li><a href="#">Modifier</a></li>
    <li><a href="#supprimer" data-rel="popup" data-position-to="window">Bulletin</a></li>
</ul>
</div>


<?php
  $total=$db->prepare('SELECT COUNT(*) AS total_eleve FROM kartable_eleves');
  $total->execute();
  $total_eleve = $total->fetch();
 ?>

<div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->

<ul data-role="listview" data-filter="true" data-filter-reveal="true" data-filter-placeholder="Rechercher dans les <?php echo $total_eleve['total_eleve'] ?> élèves inscrits ..." data-inset="true" data-theme="a">
<hr>
<?php
  $ask=$db->prepare('SELECT*  FROM kartable_eleves LEFT JOIN kartable_promotion
  ON kartable_eleves.promotion_id = kartable_promotion.id_promotion');
  $ask->execute();

while ($data1 = $ask->fetch())
{
  $classe_promo = ($data1['classe_promo'] > 1 )?($data1['classe_promo']." ième"):($data1['classe_promo']." ière année");
  $option_promo = $data1['option_promo'];

?>
    <li>
    <a href="./cmp_observation_eleve.php?id_eleve=<?php echo $data1['id_eleve'];?>" class="ui-input-btn ui-btn ui-btn-c ui-icon-user ui-btn-icon-left ui-shadow-icon" rel="external"><span style="color:black;"><?php echo $data1['noms_eleve']; ?>
    
    <label>
    <input type="checkbox" name="checkbox-0 ">Selectionner
    </label>
   
    </span>

    <div>
   * Classe : <span style="color: #3388cc;"> <?php echo $classe_promo. ' '.$option_promo; ?></span> <br>
   * Sexe : <span style="color: #3388cc;"> <?php echo $data1['sexe_eleve']; ?></span>
   </div>
    </a>
    
    </li><p>
<?php 
}?>
</ul>

<a href="#" onclick="PrintDiv();" class="ui-btn ui-mini ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-action" style="width: 150px;color: black;">Imprimer</a>
<hr>
<?php
$query=$db->prepare('SELECT*  FROM kartable_eleves LEFT JOIN kartable_promotion
ON kartable_eleves.promotion_id = kartable_promotion.id_promotion LEFT JOIN kartable_admin ON kartable_eleves.admin_id = kartable_admin.id_admin');
$query->execute();
while ($data = $query->fetch())
{
  $classe_promo = ($data['classe_promo'] > 1 )?($data['classe_promo']." ième"):($data['classe_promo']." ière année");
  $option_promo = $data['option_promo'];

?>

  <table data-role="table" data-mode="columntoggle" data-column-btn-text="Affichage..." data-column-btn-theme="a" class="phone-compare ui-shadow table-stroke" data-theme="a">
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
            <h4><?php echo $classe_promo. ' '.$option_promo; ?></h4>
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
          <li>Sexe :              <?php echo $data['sexe_eleve']; ?></li><br>
          <li>Date de Naissance : <?php echo $data['date_naissance']; ?></li><br>
          <li>Lieu de naissance : <?php echo $data['lieu_naissance']; ?></li><br>
          <li>Inscrit le : <?php echo date('d/m/Y \à H:m:s',$data['date_inscription']) ?></li>
          <li>Par l'administrateur <?php echo $data['noms_admin']; ?></li>
     
        </ul>
          </td>     
        </tr>
     <tr>
          <th class="label"> Informations</th>
      
        <td>
          <div data-role="footer">
            <div data-role="navbar" data-iconpos="left">
                <ul>
                <li><a href="./filtre_paiement_nom.php?id_eleve=<?php echo $data['id_eleve']; ?>&nom_eleve=<?php echo $data['noms_eleve']; ?>"  data-icon="gear" class="ui-btn-active" rel="external"> Historique des frais</a></li>
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
                <li><a href="./cmp_observation_eleve.php?id_eleve=<?php echo $data['id_eleve'];?>" rel="external" data-icon="gear" class="ui-btn-active">Observation</a></li>
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
  $quiz=$db->prepare('SELECT*  FROM kartable_eleves');
  $quiz->execute();

while ($data5 = $quiz->fetch())
{
?>
  <div data-role="popup" id="<?php echo 'delete'.$data5['id_eleve']?>" data-overlay-theme="b" data-dismissible="false" style="max-width:400px;">

<div role="main" class="ui-content" style="background-color:white;">
    <h2 class="ui-title" style="color: black;font-size: 18px;">Voulez-vous vraiment supprimer <br><?php echo '<strong style="font-weight: bold;margin-left:10%;">'.$data5['noms_eleve'].'</strong>'; ?> ?</h2>
<hr>
<p style="color: red;"><span><img src="./images/Error_color100px.png" alt="" style="height: 20px;"></span> Cette action est irreversible.</p>
    <a href="#" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b" data-rel="back" style="color: black;">Annuler</a>
    <a href="./kartable_moteur.php?action=deletePupil&amp;id_eleve=<?php echo $data5['id_eleve']; ?>" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b" style="color: black;">Supprimer</a>
</div>
</div>
<?php } ?>

<?php
  $requete=$db->prepare('SELECT*  FROM kartable_promotion LEFT JOIN kartable_eleves
  ON promotion_id = id_promotion LEFT JOIN kartable_tuteur ON kartable_tuteur.id_tuteur = kartable_eleves.id_tuteur');
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

  <div data-role="page" id="divToPrint" style="width: 100%;">
          
          <file-header></file-header>
          <?php include("./cmp_file_header.php"); ?>
          
                    <h4 style="text-align: center;font-weight; bold;">Liste exhaustive des élèves</h4>
<?php
                    
                    echo '<table class="table table-bordered" style="font-size: 10px;">' . "\n"; 
                    
                    echo '<thead style="color: #3388cc;">
                    <tr>';
                    
                    echo "<th data-priority='1'>id</th>
                          <th>Noms</th>
                          <th>Sexe</th>
                          <th>Date de naissance</th>
                          <th>Classe</th>";
                    echo '</tr></thead><tbody>';
                    
                    $query=$db->prepare('SELECT*  FROM kartable_eleves LEFT JOIN kartable_promotion
                    ON kartable_eleves.promotion_id = kartable_promotion.id_promotion LEFT JOIN kartable_admin ON kartable_eleves.admin_id = kartable_admin.id_admin');
                    $query->execute();
                    while ($data1 = $query->fetch())
                    {
                      $classe_promo = ($data1['classe_promo'] > 1 )?($data1['classe_promo']." ième"):($data1['classe_promo']." ière année");
                      $option_promo = $data1['option_promo'];
                                        
                        echo '<tr>' . "\n";  
                        echo '<td style="font-weight: bold;">' . $data1['id_eleve'] . '</td>' . "\n"; 
                        echo '<td style="font-weight: bold;">' . $data1['noms_eleve'] . '</td>' . "\n";
                        echo '<td style="font-weight: bold;">' . $data1['sexe_eleve'] . '</td>' . "\n";
                        echo '<td style="font-weight: bold;">' . $data1['date_naissance'] . '</td>' . "\n";
                        echo '<td style="font-weight: bold;">' . $classe_promo. ' '.$option_promo . '</td>' . "\n";
                        
                        echo '</tr>' . "\n";
                    } 
                    echo '</tbody>';
                    echo '</table>' . "\n";
                    ?>
                    </div>
                    
                              </div>
                              <script src="./main.js"></script>
  
  <script src="./indexVue.js"></script>
<script src="./App.js"></script>
<script type="text/javascript" src="portojs/bootstrap.min.js"></script>
<script type="text/javascript" src="portojs/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="portojs/jquery.isotope.min.js"></script>
<script type="text/javascript" src="portojs/wow.min.js"></script>
<script type="text/javascript" src="portojs/functions.js"></script>
<script type="text/javascript" src="managerJs/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="managerJs/jquery-2.1.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="managerJs/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="managerJs/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="managerJs/mdb.min.js"></script>
 <script src="SlideJs/custom.js"></script>

 <script type="text/javascript">
    // Animations initialization
    new WOW().init();

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

    </body>

    </html>