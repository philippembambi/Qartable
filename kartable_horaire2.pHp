<?php
require('database.php');
$id_promo = (isset($_GET['id_promo']))?$_GET['id_promo']:0;

$query=$db->prepare('SELECT*  FROM kartable_horaire LEFT JOIN kartable_promotion 
ON kartable_horaire.id_promo = kartable_promotion.id_promotion LEFT JOIN kartable_cours
ON kartable_horaire.id_cours = kartable_cours.id_cours
WHERE kartable_promotion.id_promotion = :id_promo');
$query->bindValue(':id_promo', $id_promo, PDO::PARAM_INT);
$query->execute();
$data = $query->fetch();
$classe_promo = ($data['classe_promo'] > 1 )?($data['classe_promo']." ième"):($data['classe_promo']." ière année");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
<!--Css Jquey mobile-->
    <link rel="stylesheet" href="jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
    <link rel="stylesheet" href="listview-grid.css">
    <link rel="stylesheet" href="assets/css/jqm-demos.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome.css">
    <link rel="stylesheet" href="css/font-awesome.css">

<!--Css importées-->
    <link rel="stylesheet" href="portofolio/animate.css">
      <link href="portofolio/prettyPhoto.css" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="css/style.css"/>
      <link href="managerCss/bootstrap.min.css" rel="stylesheet">
     
      <!-- Material Design Bootstrap -->
      <link href="managerCss/mdb.min.css" rel="stylesheet">
      <!-- Your custom styles (optional) -->
      <link href="managerCss/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CodeJs/font-awesome.css">
    <link rel="stylesheet" href="./addStyle.css">

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
<div data-role="header" data-theme="a">
		<h1>Horaire de la <?php echo $classe_promo; ?></h1>
		<a href="./" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-rel="back" data-ajax="false">Back</a>
	</div><!-- /header -->

  <?php
$q=$db->prepare('SELECT*  FROM kartable_horaire LEFT JOIN kartable_promotion 
ON kartable_horaire.id_promo = kartable_promotion.id_promotion LEFT JOIN kartable_cours
ON kartable_horaire.id_cours = kartable_cours.id_cours
WHERE kartable_promotion.id_promotion = :id_promo');
$q->bindValue(':id_promo', $id_promo, PDO::PARAM_INT);
$q->execute();
  ?>
    <div data-role="collapsible" data-theme="a" data-content-theme="a">
        <h2>Selectionner un cours...</h2>
            <ul data-role="listview" data-filter="true">
              <?php 
              while($data1 = $q->fetch()) 
              {
                ?>
                <li><a href="#"><?php echo $data1['intitule_cours']; ?></a></li>
              
                <?php } ?>
              </ul>
        </div>

  
        <div class="row">
          <div class="col-md-12">
            <table 
            data-role="table" 
            id="table-custom-2" 
            data-mode="columntoggle" 
            class="ui-body-d ui-shadow table-stripe ui-responsive" 
            data-column-btn-theme="b" 
            data-column-btn-text="Columns to display..." 
            data-column-popup-theme="a" data-priority="1">
              <thead>
                <tr>
                  <th><h3 style="color: #3388cc;font-family: leelawadee;">Lundi</h3></th>
                  <th data-priority="2">Cours</th>
                  <th data-priority="3">Heure</th>
                  <th data-priority="4">Pondération</th>
                </tr>
              </thead>
  
<?php
$request=$db->prepare("SELECT*  FROM kartable_horaire LEFT JOIN kartable_promotion 
ON kartable_horaire.id_promo = kartable_promotion.id_promotion LEFT JOIN kartable_cours
ON kartable_horaire.id_cours = kartable_cours.id_cours
WHERE kartable_promotion.id_promotion = :id_promo AND kartable_cours.jour = 'Lundi' ");
$request->bindValue(':id_promo', $id_promo, PDO::PARAM_INT);
$request->execute();
//$data2 = $request->fetch();
?>
              <tbody>
                <tr class="ui-bar-d">
                  <td  rowspan="3">Horaire</td>
                 
                  <td>
                  <?php 
              while($data2 = $request->fetch()) 
              {
                ?>  
                <strong style="font-weight: bold;">
                  <?php echo $data2['intitule_cours']; ?>
              </strong>
                  <hr>
                  <?php }
                  $request->CloseCursor();
                  ?>
                </td> 
  
                  <td>
                  <?php 
              for($i = 1; $i <=6; $i++) 
              {
                ?>  <strong style="font-weight: bold;">
                  <?php echo $i; ?>
              </strong>
                  <hr>
                  <?php }
                  ?>
                  </td>

                  <?php
$request=$db->prepare("SELECT*  FROM kartable_horaire LEFT JOIN kartable_promotion 
ON kartable_horaire.id_promo = kartable_promotion.id_promotion LEFT JOIN kartable_cours
ON kartable_horaire.id_cours = kartable_cours.id_cours
WHERE kartable_promotion.id_promotion = :id_promo AND kartable_cours.jour = 'Lundi' ");
$request->bindValue(':id_promo', $id_promo, PDO::PARAM_INT);
$request->execute();
//$data2 = $request->fetch();
?>
                  <td>
                  <?php 
              while($data4 = $request->fetch()) 
              {
                ?>  <strong style="font-weight: bold;">
                  <?php echo $data4['ponderation']; ?>
                  </strong>
                  <hr>
              <?php }  ?>
                </td>
                </tr>
               </tbody>
              </table>




              <table 
            data-role="table" 
            id="table-custom-2" 
            data-mode="columntoggle" 
            class="ui-body-d ui-shadow table-stripe ui-responsive" 
            data-column-btn-theme="b" 
            data-column-btn-text="Columns to display..." 
            data-column-popup-theme="a" data-priority="1">
              <thead>
                <tr>
                  <th><h3 style="color: #3388cc;font-family: leelawadee;">Mardi</h3></th>
                  <th data-priority="2">Cours</th>
                  <th data-priority="3">Heure</th>
                  <th data-priority="4">Pondération</th>
                </tr>
              </thead>
  
<?php
$request=$db->prepare("SELECT*  FROM kartable_horaire LEFT JOIN kartable_promotion 
ON kartable_horaire.id_promo = kartable_promotion.id_promotion LEFT JOIN kartable_cours
ON kartable_horaire.id_cours = kartable_cours.id_cours
WHERE kartable_promotion.id_promotion = :id_promo AND kartable_cours.jour = 'Lundi' ");
$request->bindValue(':id_promo', $id_promo, PDO::PARAM_INT);
$request->execute();
//$data2 = $request->fetch();
?>
              <tbody>
                <tr class="ui-bar-d">
                  <td  rowspan="3">Horaire</td>
                 
                  <td>
                  <?php 
              while($data2 = $request->fetch()) 
              {
                ?>  
                <strong style="font-weight: bold;">
                  <?php echo $data2['intitule_cours']; ?>
              </strong>
                  <hr>
                  <?php }
                  $request->CloseCursor();
                  ?>
                </td> 
  
                  <td>
                  <?php 
              for($i = 1; $i <=6; $i++) 
              {
                ?>  <strong style="font-weight: bold;">
                  <?php echo $i; ?>
              </strong>
                  <hr>
                  <?php }
                  ?>
                  </td>

                  <?php
$request=$db->prepare("SELECT*  FROM kartable_horaire LEFT JOIN kartable_promotion 
ON kartable_horaire.id_promo = kartable_promotion.id_promotion LEFT JOIN kartable_cours
ON kartable_horaire.id_cours = kartable_cours.id_cours
WHERE kartable_promotion.id_promotion = :id_promo AND kartable_cours.jour = 'Lundi' ");
$request->bindValue(':id_promo', $id_promo, PDO::PARAM_INT);
$request->execute();
//$data2 = $request->fetch();
?>
                  <td>
                  <?php 
              while($data4 = $request->fetch()) 
              {
                ?>  <strong style="font-weight: bold;">
                  <?php echo $data4['ponderation']; ?>
                  </strong>
                  <hr>
              <?php }  ?>
                </td>
                </tr>
               </tbody>
              </table>

          </div>
          </div>
          </body>
    </html>