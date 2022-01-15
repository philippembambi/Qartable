<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Fiches et Bulletins</title>
	<!--Css Jquey mobile-->
    <link rel="stylesheet" href="./jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
    <link rel="stylesheet" href="./assets/css/jqm-demos.css">
<!--Css importées-->
    <link rel="stylesheet" href="./portofolio/animate.css">
      <link href="./portofolio/prettyPhoto.css" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="./css/style.css"/>
      <link href="./managerCss/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="./css/font-awesome.css">

      <!-- Your custom styles (optional) -->
      <link href="./managerCss/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/addStyle.css">
	<link rel="stylesheet" href="./listview-grid.css">

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


<div data-role="page" id="page1" data-theme="b" class="my-page">
	<!--composant formulaire-->
	<app-formulaire></app-formulaire>
<?php include("./template_formulaire.php"); ?>

	<div data-role="header">

		<h1 style="color: white;font-size:20px;">Fiches et Bulletins de la classe</h1>
		<a href="./" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-rel="back" data-ajax="false">Back</a>
	</div><!-- /header -->


	<div role="main" class="ui-content">

        <ul data-role="listview" data-inset="true">
        	<li><a href="./import_pdf.php">
            	<img src="./images/PDF_100px.png" class="ui-li-thumb">
            	<p>Importer des bulletins</p>
                <p class="ui-li-aside">Document PDF</p>
            </a></li>

            <li><a href="./bulletin_Reader.php" target="_blank">
            	<img src="./images/Excel_color.png" class="ui-li-thumb">
            	 <p>Ouvrir la feuille de bulletin</p>
                <p class="ui-li-aside">Microsoft Excel</p>
            </a></li>

            <li><a href="#">
            	<img src="./images/Microsoft8Word_100px.png" class="ui-li-thumb">
            	 <p>Utiliser un enregistrement Word</p>
                <p class="ui-li-aside">Microsoft Word</p>
            </a></li>

			<li><a href="#">
            	<img src="./images/Database_Administrator_color.png" class="ui-li-thumb">
            	 <p>Document externes</p>
                <p class="ui-li-aside">SQL</p>
            </a></li>

        </ul>

    </div><!-- /content -->

</div><!-- /page -->

<script src="./main.js"></script>
<script type="text/javascript" src="portojs/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="portojs/jquery.isotope.min.js"></script>
<script type="text/javascript" src="portojs/wow.min.js"></script>
<script type="text/javascript" src="portojs/functions.js"></script>
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
