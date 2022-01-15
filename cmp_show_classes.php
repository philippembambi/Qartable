<?php
require('database.php');
include('kartable_debut.php');
?>
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
<div data-role="header" data-theme="a">
		<h1 style="font-size: 20px;">Liste exhaustive des options</span></h1>
		<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" rel="external" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-ajax="false">Back</a>
  	<a href="#" onclick="window.location.reload();" rel="external" data-shadow="false" data-iconshadow="false" data-icon="recycle" data-iconpos="notext" data-ajax="false">Back</a>
  	</div><!-- /header -->


  <div data-role="main" class="ui-content jqm-content jqm-fullwidth"> <!--Debut de main-->


<?php
$req=$db->prepare('SELECT*  FROM kartable_promotion');
$req->execute();

echo '<table 
data-role="table" 
data-mode="columntoggle" 
class="ui-body-a ui-shadow table-stripe ui-responsive" 
data-column-btn-theme="a" 
data-column-btn-text="Affichage..." 
data-column-popup-theme="a">' . "\n"; 

echo '<thead style="color: #3388cc;">
<tr>';

echo "<th data-priority='1'>Id Classe</th>
      <th>Classe</th>
      <th>option</th>
      <th>Action</th>";
echo '</tr></thead><tbody>';

while ($data1 = $req->fetch())
{
  if($data1['option_promo'] == 'Latin Philo')
  {
    $option = 'latinphilo';
  }
  elseif($data1['option_promo'] == 'Chimie Biologie')
  {
    $option = 'biochimie';
  }
  elseif($data1['option_promo'] == 'Commerciale Info')
  {
    $option = 'commerciale';
  }
  else{
    $option = 'Aucune';
  }

    $classe_promo = ($data1['classe_promo'] > 1 )?($data1['classe_promo']." ième année"):($data1['classe_promo']." ière année");

    echo '<tr>' . "\n";  
    echo '<td style="font-weight: bold;">' . $data1['id_promotion'] . '</td>' . "\n"; 
    echo '<td style="font-weight: bold;">' . $classe_promo . '</td>' . "\n";
    echo '<td style="font-weight: bold;">' . $data1['option_promo'] . '</td>' . "\n";
    echo '<td style="font-weight: bold;"> <a href="./kartable_promo.php?Maclasse='.$data1['classe_promo'].'&amp;Masection='.$option.'" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-plus" style="width: 80px;" rel="external" target="_blank" data-ajax="false">Ouvrir</a>
    </td>' . "\n";
    echo '</tr>' . "\n";
} 
echo '</tbody>';
echo '</table>' . "\n";
?>
</div>

          </div>
          </div>
          </body>
    </html>