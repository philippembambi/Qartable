<?php
require('database.php');
include('kartable_debut.php');
$query2=$db->prepare('SELECT COUNT(*) AS nbre_message FROM messagerie_privee LEFT JOIN kartable_admin
ON messagerie_privee.id_destinateur = kartable_admin.id_admin 
WHERE messagerie_privee.id_destinateur = :id_admin');
$query2->bindValue(':id_admin', (int) $id_admin, PDO::PARAM_INT);
$query2->execute();
$data2 = $query2->fetch();
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
<style>
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
	background-color:#eee;
	border-radius:0px 4px 4px;
}

.blog-comments .media .media-left:before {
	content:"";
	position:absolute;
	right:0;
	top:0;
	border-style: solid;
	border-width: 0px 15px 15px;
	border-color: transparent #eee transparent transparent;
}

.blog-comments .media-left {
	position:relative;
	padding-right:20px;
}

.blog-comments .media-left img {
	width:70px;
	height:70px;
	background-color:#eee;
	border-radius:50%;
}

.blog-comments .media .date-reply {
	font-size:12px;
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
</style>
</head>
<body>
<div data-role="page" class="jqm-demos ui-responsive-panel" data-theme="" id="page1" data-title="Messagerie privée">

<div data-role="header" data-theme="a">
		<h1 style="color: #3388cc;font-weight: bold;font-size: 18px;">Boîte de réception : <?php echo $data2['nbre_message']; ?> message (s)</h1>
		<a href="./" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-rel="back" data-ajax="false">Back</a>
	</div><!-- /header -->

<?php
$query=$db->prepare('SELECT *  FROM messagerie_privee LEFT JOIN kartable_admin
ON messagerie_privee.id_expediteur = kartable_admin.id_admin 
WHERE messagerie_privee.id_destinateur = :id_admin ORDER BY date_msg DESC');
$query->bindValue(':id_admin', (int) $id_admin, PDO::PARAM_INT);
$query->execute();

while($data = $query->fetch())
{
$req=$db->prepare('UPDATE messagerie_privee SET lu = "oui"
WHERE messagerie_privee.id_destinateur = :id_admin');
$req->bindValue(':id_admin', (int) $id_admin, PDO::PARAM_INT);
$req->execute();
$req->fetch();
?>
<div class="blog-comments" style="margin-left: 3%;margin-right: 3%;">
							<div class="media">
								<div class="media-left">
                                <img src="images/user.png" class="rounded-circle img-responsive" alt="Avatar photo">
                                </div>
								<div class="media-body" style="width:100%;">
									<h5 class="media-heading">
                                    <?php echo $data['noms_admin']; ?>
                                </h5>
<hr>
                                <h5 style="color: #3388cc;"><?php echo $data['titre_msg']; ?></h5>
                                <div class="date-reply" style="font-size: 17px;">
                                    <?php echo $data['contenu_msg'];?>
                                </div>

                                <div class="date-reply" style="text-transform:uppercase;">
                                Date : <?php echo $data['date_msg']; ?>
                                </div>

                                    </div></div>
</div>

<?php } ?>