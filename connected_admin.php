<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <link rel="shortcut icon" type="image/png" href="./images/logo.png">
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
      <!-- Your custom styles (optional) -->
      <link href="managerCss/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/addStyle.css">
   <!--Vue.js--> 
  <script src="./vue.js"> </script>
  <script src="./managerJs/myscripts.js"></script>
  <script src="./kartable_ajax.js"></script>
  
<!--Js Jquery mobile-->
    <script src="./jquery-2.1.1.min.js"></script>
    <script src="./jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>

    <script>
  
  $.mobile.document.on( "pagebeforeshow", function(){
    make_sleep();
  
  });
    </script>
  </head>
  <body>

<?php
$message = (isset($_GET['message']))?htmlspecialchars($_GET['message']):'';

if($message != '')
{
?>
<div class="alert alert-success" role="alert">
       <h5> <strong><i class="fa fa-thumbs-o-up fa-2x"></i> <?php echo $message ?></strong></h5>
      </div>
<?php } ?>    



<?php
require('database.php');
include('kartable_debut.php');
?>

<?php
$time_max = time() - (60 * 5); 
$quiz=$db->prepare('SELECT * FROM kartable_whosonline LEFT JOIN kartable_admin 
ON online_id = id_admin WHERE online_time > :timemax AND online_id <> 0'); 
$quiz->bindValue(':timemax', $time_max, PDO::PARAM_INT); 
$quiz->execute();

while ($data5 = $quiz->fetch())
{
?>
  <div data-role="popup" id="<?php echo 'delete'.$data5['id_admin']?>" data-overlay-theme="b" data-dismissible="false" style="max-width:400px;">

<div role="main" class="ui-content" style="background-color:white;">
    <h2 class="ui-title" style="color: black;font-size: 18px;">Voulez-vous vraiment supprimer <br><?php echo '<strong style="font-weight: bold;margin-left:10%;">'.$data5['noms_admin'].'</strong>'; ?> ?</h2>
<hr>
<p style="color: red;"><span><img src="./images/Error_color100px.png" alt="" style="height: 20px;"></span> Cette action est irreversible.</p>
    <a href="#" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b" data-rel="back">Annuler</a>
    <a href="./kartable_moteur.php?action=deleteAdmin&id_admin_session=<?php echo $data['id_admin'];?>" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b" >Supprimer</a>
</div>
</div>
<?php } ?>


<?php
$count_online = 0; //Décompte des visiteurs 

$time_max = time() - (60 * 5); 
$query=$db->prepare('SELECT * FROM kartable_whosonline LEFT JOIN kartable_admin 
ON online_id = id_admin WHERE online_time > :timemax AND online_id <> 0'); 
$query->bindValue(':timemax', $time_max, PDO::PARAM_INT); 
$query->execute(); $count_membres=0; 

$count_membres=0;
while ($data = $query->fetch())
{
$count_membres ++;
}
$count_online = $count_membres;
?>


<br>


<ul data-role="listview" data-inset="true">
    <li data-role="list-divider" data-theme="b">
        <h1 style="color: white;">
        <?php
if($count_online == 1 && $id_admin != 0)
{
echo '<span style="font-size: 17px">Administrateur connecté</span> : <b style="font-size: 18px;">'.$count_online.'</b>'; 
}
elseif($count_online > 1 && $id_admin != 0)
{
echo '<span style="font-size: 17px">Administrateurs connectés</span> : <b style="font-size: 18px;">'.$count_online.'</b>'; 
}
else{
    echo 'Aucun Administrateur connecté';
}
?></h1>
    </li>
<?php
$time_max = time() - (60 * 5); 
$q=$db->prepare('SELECT * FROM kartable_whosonline LEFT JOIN kartable_admin 
ON online_id = id_admin WHERE online_time > :timemax AND online_id <> 0'); 
$q->bindValue(':timemax', $time_max, PDO::PARAM_INT); 
$q->execute(); $count_membres=0; 

$count_membres=0;
while ($data = $q->fetch())
{
$count_membres ++;
?>
    <li>
        <h1><?php echo $data['noms_admin']; ?></h1>
        <ul>
            <li>Dernière connection : <?php echo date('d/m/Y \à H:m:s', $data['date_last_connetion']); ?></li>
            <li>
            <li class="ui-body ui-body-a">
            <fieldset class="ui-grid-a">
                    <div class="ui-block-a">
                        <a href="./kartable_moteur.php?action=stopSession&id_admin_session=<?php echo $data['id_admin'];?>" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-btn-icon-left ui-icon-minus">Arrêter la session</a>
                    </div>
            </fieldset>
        </li>
        </li>
        </ul>
    </li>

<?php } ?>
</ul>

</body>
</html>