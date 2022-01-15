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

<div data-role="page" class="jqm-demos ui-responsive-panel" id="page1" data-title="personnel" data-url="list_personnels" data-theme="c">


<div data-role="header" data-theme="a">
<h1 style="font-weight: bolder;">Liste exhaustive de tous les employés</span></h1>
		<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" rel="external" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-ajax="false">Back</a>
		<a href="#" onclick="window.location.reload();" rel="external" data-shadow="false" data-iconshadow="false" data-icon="recycle" data-iconpos="notext" data-ajax="false">Back</a>
  </div><!-- /header -->

<div data-role="popup" id="parametre" data-theme="a">
<ul data-role="listview" data-inset="true" style="min-width:210px;">
    <li data-role="list-divider">Choisir une action</li>
    <li><a href="#">Modifier</a></li>
    <li><a href="#supprimer" data-rel="popup" data-position-to="window">Bulletin</a></li>
</ul>
</div>


<?php
  $total=$db->prepare('SELECT COUNT(*) AS total_personnel FROM kartable_personnel');
  $total->execute();
  $total_personnel = $total->fetch();
 ?>

<div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->
<ul data-role="listview" data-filter="true" data-filter-reveal="true" data-filter-placeholder="Rechercher dans les <?php echo $total_personnel['total_personnel'] ?> personnel enregistrés ..." data-inset="true" data-theme="a">
<hr>
<?php
  $ask=$db->prepare('SELECT*  FROM kartable_personnel');
  $ask->execute();

while ($data1 = $ask->fetch())
{
?>
    <li>
    <a href="<?php echo '#'.$data1['id_personel']?>" data-rel="popup" data-position-to="window" class="ui-input-btn ui-btn ui-btn-c ui-icon-user ui-btn-icon-left ui-shadow-icon"><span style="color:black;"><?php echo $data1['noms_personel']; ?>
    <label>
    <input type="checkbox" name="checkbox-0 ">Selectionner
    </label>
   
    </span>
    </a>
    
    </li><p>
<?php 
}?>
</ul>

<a href="#" onclick="PrintDiv();" class="ui-btn ui-mini ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-action" style="width: 150px;color: black;">Imprimer</a>

<?php
$query=$db->prepare('SELECT*  FROM kartable_personnel');
$query->execute();
while ($data = $query->fetch())
{
?>

  <table data-role="table" data-mode="columntoggle" data-column-btn-text="Affichage..." data-column-btn-theme="a" class="phone-compare ui-shadow table-stroke" data-theme="a">
 <thead>    
        <tr style="font-family: leelawadee;">
          <th class="label" data-priority="<?php echo (!empty($data['id_personel']))?$data['id_personel']:"Vide"; ?>">Noms</th>
  
<?php
$q=$db->prepare('SELECT*  FROM kartable_personnel LEFT JOIN kartable_admin 
ON kartable_admin.id_admin = kartable_personnel.id_admin
WHERE id_personel = :id');
$q->bindValue(':id', $data['id_personel'], PDO::PARAM_INT);
$q->execute();
while ($data1 = $q->fetch())
{
?>
          <th data-priority="<?php echo $data1['id_personel'];?>"><?php echo $data['id_personel'];?></th>
<?php  } ?>          
      <th>
            <h4 style="color:#3388cc;"><?php echo $data['noms_personel']; ?></h4>
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
<li>Sexe :              <?php echo $data['sexe']; ?></li><br>
<li>Fonction :  <?php echo $data['fonction']; ?></li><br>
<li>Adresse : <?php echo $data['adresse']; ?></li><br>
<li>Téléphone :  <?php echo $data['tel']; ?></li>       

        </ul>
          </td>     
        </tr>
     <tr>
          <th class="label"> Informations</th>
      
        <td>
          <div data-role="footer">
            <div data-role="navbar" data-iconpos="left">
                <ul>
                  <li><a href="cmp_observation_personnel.php?id_personnel=<?php echo $data['id_personel'];?>" rel="external" data-icon="gear" class="ui-btn-active"> Observation</a></li>
                 <li>
                 <a href="#" data-icon="edit" >&Eacute;diter</a></li>
                </ul>
            </div><!-- /navbar -->
        </div><!-- /footer -->
        </td>

        <td>
          <div data-role="footer">
            <div data-role="navbar" data-iconpos="left">
                <ul>
                  <li><a href="filtre_salaire_by_nom_personnel.php?personnel=<?php echo $data['id_personel']; ?>" rel="external" data-icon="grid" data-ajax="false" class="ui-btn-active">Bulletin de paie</a></li>
                 <li><a href="<?php echo '#delete'.$data['id_personel']?>" data-rel="popup" data-position-to="window" data-icon="star">Plus ...</a></li>
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

  <div data-role="page" id="divToPrint" style="width: 100%;">
          
          <file-header></file-header>
          <?php include("./cmp_file_header.php"); ?>
          
                    <h4 style="text-align: center;font-weight; bold;">Listing des personnels</h4>
<?php
                    
                    echo '<table class="table table-bordered" style="font-size: 10px;">' . "\n"; 
                    
                    echo '<thead style="color: #3388cc;">
                    <tr>';
                    
                    echo "<th data-priority='1'>id</th>
                          <th>Noms</th>
                          <th>Sexe</th>
                          <th>Fonction</th>
                          <th>Matricule</th>
                          <th>Adresse</th>
                          <th>Téléphone</th>";
                    echo '</tr></thead><tbody>';
                    
                    $query=$db->prepare('SELECT*  FROM kartable_personnel');
                    $query->execute();
                    while ($data1 = $query->fetch())
                    {                                       
                        echo '<tr>' . "\n";  
                        echo '<td style="font-weight: bold;">' . $data1['id_personel'] . '</td>' . "\n"; 
                        echo '<td style="font-weight: bold;">' . $data1['noms_personel'] . '</td>' . "\n";
                        echo '<td style="font-weight: bold;">' . $data1['sexe'] . '</td>' . "\n";
                        echo '<td style="font-weight: bold;">' . $data1['fonction'] . '</td>' . "\n";
                        echo '<td style="font-weight: bold;">' . $data1['num_matricule'] . '</td>' . "\n";
                        echo '<td style="font-weight: bold;">' . $data1['adresse'] . '</td>' . "\n";
                        echo '<td style="font-weight: bold;">' . $data1['tel'] . '</td>' . "\n";
                       
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
  
    </body>

    </html>