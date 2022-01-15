<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Fiches et Bulletins</title>
    <link rel="stylesheet" href="jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
    <link rel="stylesheet" href="assets/css/jqm-demos.css">
    <link rel="stylesheet" href="css/font-awesome.css">

<!--Css importées-->
    <link rel="stylesheet" href="portofolio/animate.css">
      <link type="text/css" rel="stylesheet" href="css/style.css"/>
      <link href="managerCss/bootstrap.min.css" rel="stylesheet">
      <link href="managerCss/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CodeJs/font-awesome.css">
  
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

<div data-role="page" id="page1" data-theme="a" class="my-page">

	<div data-role="header">

		<h1 style="font-size:20px;">Importation des bulletins</h1>
		<a href="./" data-shadow="false" data-iconshadow="false" data-icon="carat-l" data-iconpos="notext" data-rel="back" data-ajax="false">Back</a>
	</div><!-- /header -->

	<div role="main" class="ui-content">

    <form id="uploadForm" name="uploadForm" enctype="multipart/form-data" action="send_pdf.php" target="uploadFrame" method="post">
    
     <label for="file1">* Selectionner un fichier </label>
     <input type="file" data-clear-btn="true" name="uploadFile" id="uploadFile" value="" multiple>

     <label for="file1">* Selectionner un fichier </label>
     <input type="file" data-clear-btn="true" name="uploadFile2" id="uploadFile2" value="" multiple>

     <label for="file1">* Selectionner un fichier </label>
     <input type="file" data-clear-btn="true" name="uploadFile3" id="uploadFile3" value="">


     <label for="file1">* Selectionner un fichier </label>
     <input type="file" data-clear-btn="true" name="uploadFile4" id="uploadFile4" value="">

     <h6 id="fichier" name="fichier"></h6>

     <div class="ui-grid-b ui-responsive">
    
    <div class="ui-block-a"><input type="button" data-icon="check" data-iconpos="right" value="Importer" onclick="document.uploadForm.submit()"></div>
    <div class="ui-block-b"><input type="button" data-icon="minus" value="Annuler" onclick="document.formulaire.reset()"></div>
    <div class="ui-block-c"><a href="#" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-plus">Ajouter un champ</a></div>
</div>
    
    </form>

</div>
</div>

<script>
  function uploadEnd(error, path) {
if (error === 'OK') {
document.getElementById('uploadStatus').innerHTML = '<a href="./images/' + path + '">Upload effectué !</a><br/><a href="./images/' + path +
'"><img src="./images/PDF_100px.png" style="width:250px;height:200px;"/></a>';
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